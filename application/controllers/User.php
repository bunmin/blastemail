<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('migrate', TRUE);
        
        $this->load->model('user_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('username') == "") {
            redirect('login/login');
        }
    }

    public function index()
    {
        $user = $this->user_model->get_all();

        $data = array(
            'user_data' => $user,
            'konten' => 'user/user_list',
            'judul' => 'Manajemen User',
        );
        $this->load->view('v_index', $data);
    }

    public function create()
    {
        $data = array(
          'button' => 'Create',
          'action' => site_url('user/create_action'),
          'id_user' => set_value('id_user'),
          'nama' => set_value('nama'),
          'username' => set_value('username'),
          'password' => set_value('password'),
          'konten' => 'user/user_form',
          'judul' => 'Manajemen User',
        );
        $this->load->view('v_index', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
              'nama' => $this->input->post('nama', true),
              'username' => $this->input->post('username', true),
              'password' => md5($this->input->post('password', true)),
            );

            $this->user_model->insert($data);
            $this->session->set_flashdata('flag', 'success');
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }

    public function update($id)
    {
        $row = $this->user_model->get_by_id($id);

        if ($row) {
            $data = array(
              'button' => 'Update',
              'action' => site_url('user/update_action'),
              'id_user' => set_value('id_user', $row->id_user),
              'nama' => set_value('nama', $row->nama),
              'username' => set_value('username', $row->username),
              'password' => set_value('password', md5($row->password)),
              'konten' => 'user/user_form',
              'judul' => 'Manajemen User',
            );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('flag', 'danger');
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    // public function update_action()
    // {
    //     $this->_rules();
    //
    //     if ($this->form_validation->run() == false) {
    //         $this->update($this->input->post('id_user', true));
    //     } else {
    //         $data = array(
    //           'nama' => $this->input->post('nama', true),
    //           'username' => $this->input->post('username', true),
    //           'password' => $this->input->post('password', true),
    //         );
    //
    //         $this->user_model->update($this->input->post('id_user', true), $data);
    //         $this->session->set_flashdata('flag', 'success');
    //         $this->session->set_flashdata('message', 'Update Record Success');
    //         redirect(site_url('user'));
    //     }
    // }

    public function ubahpass($id)
    {
        $row = $this->user_model->get_by_id($id);

        if ($row) {
            $data = array(
              'id_user' => set_value('id_user', $row->id_user),
              'button' => 'Update',
              'action' => site_url('user/ubahpass_action'),
              'konten' => 'user/ubahpass',
              'judul' => 'Manajemen User',
            );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('flag', 'danger');
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function ubahpass_action()
    {
        $this->form_validation->set_rules('pass_baru', 'pass_baru', 'trim|required');
        $this->form_validation->set_rules('pass_admin', 'pass_admin', 'trim|required|callback__confirm_pass['.$this->session->userdata('id_user').']');

        $this->form_validation->set_rules('id_user', 'id_user', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->ubahpass($this->input->post('id_user', true));
        } else {
            $data = array(
              'password' => md5($this->input->post('pass_baru', true)),
            );

            $this->user_model->update($this->input->post('id_user', true), $data);
            $this->session->set_flashdata('flag', 'success');
            $this->session->set_flashdata('message', 'Ubah Password Success');
            redirect(site_url('user'));
        }
    }

    public function delete($id)
    {
        $row = $this->user_model->get_by_id($id);

        if ($row) {
            $this->user_model->delete($id);
            $this->session->set_flashdata('flag', 'success');
            $this->session->set_flashdata('message', 'Delete User Berhasil');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('flag', 'danger');
            $this->session->set_flashdata('message', 'User tidak ditemukan');
            redirect(site_url('user'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required|callback__unique_uname[user.id_user.0.username]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|callback__confirm_pass['.$this->session->userdata('id_user').']');

        $this->form_validation->set_rules('id_user', 'id_user', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function _confirm_pass($field_value,$param)
    {
        $id_user = $param;
        $cek_pass = $this->user_model->get_by_id($id_user);
        if ($cek_pass->password == md5($field_value)) {
            return true;
        } else {
            $this->form_validation->set_message('_confirm_pass', 'Password anda salah.');
            return false;
        }
    }

    function _unique_uname($field_value,$param)
    {
        list($table, $column,$id,$column2) = explode('.', $param);
        $cek_user = $this->db->query("SELECT * from $table where $column='$id'")->row();
        if ($cek_user->username == $field_value) {
            return true;
        } else {
            $cek_count = $this->db->query("SELECT COUNT(*) AS count from $table where $column2='$field_value' and $column<>'$id'")->row();
            if ($cek_count->count > 0) {
              $this->form_validation->set_message('_unique_uname', 'Username sudah digunakan.');
              return false;
            } else {
              return true;
            }
        }
    }
}
