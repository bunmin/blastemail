<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class emaillog extends CI_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('security');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('emaillog_model');

        if ($this->session->userdata('username') == "") {
            redirect('login/login');
        }
    }

    public function index() {
        $log_list = $this->EmailLog_model->get_all_log();

        $data = array(
            'konten' => 'emaillog/log_list',
            'judul' => 'Email Log List',
            'log_data' => $log_list,
        );
        $this->load->view('v_index', $data);
    }
}