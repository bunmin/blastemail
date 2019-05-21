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
}
