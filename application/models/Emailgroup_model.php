<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class emailGroup_model extends CI_Model
{

    public $table = 'email_group';
    public $id = 'uuid';
    public $order = 'created_dt desc';

    function __construct()
    {
        parent::__construct();
    }

    function get_all_group()
    {
        $this->db->order_by($this->order);
        return $this->db->get($this->table)->result();
    }

    function get_group_by_id($uuid)
    {
        $this->db->order_by($this->order);
        $this->db->where($this->id,$uuid);
        return $this->db->get($this->table)->result();
    }

    function get_group_detail_by_id($uuid)
    {
        $this->db->order_by('id asc');
        $this->db->where('uuid_email_group',$uuid);
        return $this->db->get('email_group_detail')->result();
    }

    function insert_group($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function insert_multiple_group_detail($data){
		$this->db->insert_batch('email_group_detail', $data);
    }
    
    function delete_all($uuid)
    {
        $this->db->where($this->id, $uuid);
        $this->db->delete($this->table);

        $this->db->where('uuid_email_group', $uuid);
        $this->db->delete('email_group_detail');
    }
}
