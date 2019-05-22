<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class emailgroup extends CI_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('security');
        $this->load->helper('url');
        $this->load->helper("file");
        $this->load->library('form_validation');
        $this->load->model('emailgroup_model');

        if ($this->session->userdata('username') == "") {
            redirect('login/login');
        }
    }

    public function index() {
        $group_list = $this->emailgroup_model->get_all_group();

        $data = array(
            'konten' => 'emailgroup/group_list',
            'footerplus1' => 'emailgroup/modal',
            'judul' => 'Email Group List',
            'group_data' => $group_list,
        );
        $this->load->view('v_index', $data);
    }

    public function get_group_detail() {
        $uuid = $this->input->post('uuid', true);
        $email_list = $this->emailgroup_model->get_group_detail_by_id($uuid);

        $data = array(
            'email_data' => $email_list,
        );

        $this->load->view('emailgroup/modal', $data);
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('emailgroup/create_action'),
            'konten' => 'emailgroup/group_form',
            'judul' => 'Create Group',
        );
        $this->load->view('v_index', $data);
    }

    public function create_action()
    {
        $name_form = "csv";

        $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|is_unique[email_group.group_name]');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

            $uuid = $this->db->query("SELECT uuid() uuid")->row();
            $uuid = $uuid->uuid;

            $path = "upload/tmp/";
            if (!is_dir($path)) {
                mkdir($path, 0777, TRUE);
            }

            $upload = $this->upload_file($uuid,$name_form,$path);
            if($upload['result'] == "success"){
                include APPPATH.'third_party/PHPExcel/PHPExcel.php';

                $csvreader = PHPExcel_IOFactory::createReader('CSV');
                $loadcsv = $csvreader->load($path.$uuid.'.csv'); // Load file yang tadi diupload ke folder csv
                $sheet = $loadcsv->getActiveSheet()->getRowIterator();

                $data_dateil = array();
                $numrow = 1;
                foreach($sheet as $row){
                    if($numrow > 1){
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);

                        $get = array();
                        foreach ($cellIterator as $cell) {
                            array_push($get, $cell->getValue());
                        }

                        $email = $get[0]; //get first column

                        array_push($data_dateil, array(
                            'uuid_email_group'=>$uuid,
                            'email'=>$email,
                        ));
                    }
                    $numrow++;
                }

                if (!empty($data_dateil)) {
                    // First : insert to parent of group
                    $group_name = $this->input->post('group_name', true);

                    $data = array(
                        'uuid'=>$uuid,
                        'group_name' => $group_name,
                    );

                    $this->emailgroup_model->insert_group($data);

                    // Second : insert to detail of group
                    $this->emailgroup_model->insert_multiple_group_detail($data_dateil);

                    // Third : delete file uploaded
                    unlink($path.$uuid.'.csv');

                    $this->session->set_flashdata('flag', 'success');
                    $this->session->set_flashdata('message', 'Create group success');
                    redirect(site_url('emailgroup'));
                } else {
                    $this->session->set_flashdata('flag', 'danger');
                    $this->session->set_flashdata('message', 'The CSV file you have uploaded is empty');
                    redirect(site_url('emailgroup/create'));
                }
            } else {
                $this->session->set_flashdata('flag', 'danger');
                $this->session->set_flashdata('message', $upload['error']);
                redirect(site_url('emailgroup/create'));
            }
        }
    }

    public function delete($uuid)
    {
        $row = $this->emailgroup_model->get_group_by_id($uuid);

        if ($row) {
            $this->emailgroup_model->delete_all($uuid);
            $this->session->set_flashdata('flag', 'success');
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('emailgroup'));
        } else {
            $this->session->set_flashdata('flag', 'danger');
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('emailgroup'));
        }
    }

    public function upload_file($filename,$name_form,$path){
		$this->load->library('upload');

		$config['upload_path'] = $path;
		$config['allowed_types'] = 'csv';
		// $config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;

		$this->upload->initialize($config);
		if($this->upload->do_upload($name_form)){
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
        }
    }
}
