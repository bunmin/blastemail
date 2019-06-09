<?php
defined('BASEPATH') or exit('No direct script access allowed');

class client_action extends CI_Controller
{
    function __construct()
    {
      parent::__construct();
      $this->db = $this->load->database('migrate', TRUE);

      $this->load->model('app_model');
    }

    public function action($action = '',$uuid,$urlid='')
    {
        $date_action = $this->app_model->dt_now();
        $date_action = $date_action->date_now;
        
        if ($action == "read") {
            $read_action = $this->app_model->update_emaillog($date_action,$uuid);
            $custom_action = $this->app_model->update_emaillog_detail($action,$uuid,$date_action);
        };

        // if (!$action == "") {
        //     $custom_action = $this->app_model->update_emaillog_detail($action,$uuid,$date_action);
        // };

        if (strpos($action, 'click_') !== false) {
            $url_redirect = $this->app_model->get_urlredirect_by_id($urlid);
            $url_redirect = $url_redirect->url;

            $click_action = $this->app_model->update_emaillog_detail($action,$uuid,$date_action,$url_redirect);

            redirect($url_redirect);
        };

        die();
    }
}
