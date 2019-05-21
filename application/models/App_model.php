<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class app_model extends CI_Model
{

    public $table = '';
    public $id = '';
    public $order = '';

    function __construct()
    {
        parent::__construct();
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
}
