<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class app_model extends CI_Model
{
    public $table = '';
    public $id = '';
    public $order = '';

    function __construct()
    {
        parent::__construct();
    }

    function dt_now()
    {
        return $this->db->query("select now() as date_now")->row();
    }

    function get_log_by_id($uuid)
    {
        $this->db->where('uuid',$uuid);
        return $this->db->get('email_log')->row();
    }

    function insert_email_single($data)
    {
        $this->db->insert('email_log', $data);
    }

    function update_read($uuid)
    {
        $this->db->query("UPDATE email_log set read_dt = now() where uuid = ?", array($uuid));
    }

    function update_emaillog($date_action, $uuid)
    {
        $this->db->query("UPDATE email_log set read_dt = ? where uuid = ?", array($date_action,$uuid));
    }

    function update_emaillog_detail($action = '',$uuid, $date_action, $description = '')
    {
        $this->db->query("INSERT email_log_detail (email_log_uuid, log_action, excuted_date,description) values (?,?,?) ", array($uuid,$action,$date_action,$description));
    }

    function insert_url_redirect($data)
    {
        $this->db->insert('url_redirect', $data);
    }

    function get_urlredirect_by_id($uuid)
    {
        $this->db->where('uuid',$uuid);
        return $this->db->get('url_redirect')->row();
    }
}
