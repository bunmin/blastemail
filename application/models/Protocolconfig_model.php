<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class protocolconfig_model extends CI_Model
{

    public $table = 'protocol_setting';
    public $id = 'id';
    public $order = 'created_dt desc';

    function __construct()
    {
        parent::__construct();
    }

    function get_protocol_enable()
    {
        $this->db->where('enable','1');
        return $this->db->get($this->table)->result();
    }

    function get_protocol_detail_by_protocol($protocol)
    {
        $this->db->order_by('id asc');
        $this->db->where('protocol',$protocol);
        return $this->db->get('protocol_setting')->result();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function update_all($data)
    {
        $this->db->update($this->table, $data);
    }

    function delete_custom_column($column,$value)
    {
        $this->db->where($column, $value);
        $this->db->delete($this->table);
    }
}
