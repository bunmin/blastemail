<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class protocolconfig extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->db = $this->load->database('migrate', TRUE);

        $this->load->helper('security');
        $this->load->helper('url');
        $this->load->helper('cryptomd5');
        $this->load->library('form_validation');
        $this->load->model('protocolconfig_model');

        if ($this->session->userdata('username') == "") {
            redirect('login/login');
        }
    }

    public function index() {
        $detail_protocol = $this->protocolconfig_model->get_protocol_enable();

        $data = array(
            'konten' => 'protocolconfig/config_form',
            'judul' => 'Protocol Configuration',
            'footerplus1' => 'protocolconfig/include_js',
            'detail_protocol' => $detail_protocol,
        );
        $this->load->view('v_index', $data);
    }

    public function get_protocol_detail() {
        $protocol = $this->input->post('protocol', true);
        $detail_protocol = $this->protocolconfig_model->get_protocol_detail_by_protocol($protocol);
        $data = array(
            'detail_protocol' => $detail_protocol,
        );

        $this->load->view('protocolconfig/form_smtp', $data);
    }

    public function save_action()
    {
        
        $this->form_validation->set_rules('protocol_option', 'Protocol', 'trim|required');

        $protocol = $this->input->post('protocol_option', true);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            // if ($protocol == "smtp") {
            if (in_array($protocol, array("smtp","mail","sendmail"))) {
                $this->form_validation->set_rules('smtp_host', 'SMTP Host', 'trim|required');
                $this->form_validation->set_rules('smtp_port', 'SMTP Port', 'trim|required');
                $this->form_validation->set_rules('smtp_user', 'SMTP User', 'trim|required');
                $this->form_validation->set_rules('smtp_pass', 'SMTP Password', 'trim|required');
                // $this->form_validation->set_rules('smtp_crypto', 'SMTP Crypto', 'trim|required');
                $this->form_validation->set_rules('mail_type', 'Mail Type', 'trim|required');
                $this->form_validation->set_rules('charset', 'Charset', 'trim');
                $this->form_validation->set_rules('word_wrap', 'Word Wrap', 'trim|required');
                $this->form_validation->set_rules('smtp_timeout', 'SMTP Timeout', 'trim|required');
                $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

                if ($this->form_validation->run() == false) {
                    $this->index();
                } else {
                    $smtp_host = $this->input->post('smtp_host', true);
                    $smtp_port = $this->input->post('smtp_port', true);
                    $smtp_user = $this->input->post('smtp_user', true);
                    $smtp_pass = encrypt($this->input->post('smtp_pass', true));
                    $smtp_crypto = $this->input->post('smtp_crypto', true);
                    $mail_type = $this->input->post('mail_type', true);
                    $charset = $this->input->post('charset', true);
                    $word_wrap = $this->input->post('word_wrap', true);
                    $smtp_timeout = $this->input->post('smtp_timeout', true);

                    $configs = array(
                        "smtp_host" => $smtp_host,
                        "smtp_port" => $smtp_port,
                        "smtp_user" => $smtp_user,
                        "smtp_pass" => $smtp_pass,
                        "smtp_crypto" => $smtp_crypto,
                        "mail_type" => $mail_type,
                        "charset" => $charset,
                        "word_wrap" => $word_wrap,
                        "smtp_timeout" => $smtp_timeout,
                    );

                    

                    //first - set another config to false
                    $this->protocolconfig_model->update_all(array("enable" => 0));
                    //second - delete same protocol config
                    $this->protocolconfig_model->delete_custom_column('protocol',$protocol);
                    //third - insert new config
                    foreach ($configs as $key => $value) {
                        $data = array(
                            'protocol' => $protocol,
                            'setting' => $key,
                            'value' => $value,
                            'enable' => 1,
                        );

                        $this->protocolconfig_model->insert($data);
                    }

                    $this->session->set_flashdata('flag', 'success');
                    $this->session->set_flashdata('message', 'Success save config');
                    redirect(site_url('protocolconfig'));
                }
            }
        }
    }
}
