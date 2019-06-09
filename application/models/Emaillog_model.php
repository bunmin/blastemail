<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class emailLog_model extends CI_Model
{

    public $table = 'email_log';
    public $id = 'uuid';
    public $order = 'send_dt desc';

    function __construct()
    {
        parent::__construct();
    }

    function get_all_log()
    {
        $this->db->order_by($this->order);
        return $this->db->get($this->table)->result();
    }

    function get_log_detail_by_id($uuid)
    {
        $this->db->order_by('detail_id asc');
        $this->db->where('email_log_uuid',$uuid);
        return $this->db->get('email_log_detail')->result();
    }
}
