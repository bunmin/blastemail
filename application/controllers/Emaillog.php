<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class emaillog extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->db = $this->load->database('migrate', TRUE);

        $this->load->helper('security');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('emaillog_model');

        if ($this->session->userdata('username') == "") {
            redirect('login/login');
        }
    }

    public function index() {
        $log_list = $this->emaillog_model->get_all_log();

        $data = array(
            'konten' => 'emaillog/log_list',
            'footerplus1' => 'emaillog/include_js',
            'judul' => 'Email Log List',
            'log_data' => $log_list,
        );
        $this->load->view('v_index', $data);
    }

    public function get_email_log_detail() {
        $uuid = $this->input->post('uuid', true);
        $log_detail = $this->emaillog_model->get_log_detail_by_id($uuid);

        $data = array(
            'email_log_detail' => $log_detail,
        );

        $this->load->view('emaillog/modal', $data);
    }
}
