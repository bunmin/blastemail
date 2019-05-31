<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{
    function __construct()
    {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('app_model');
      $this->load->helper('cryptomd5');
    }

    public function login()
    {
        // echo encrypt($this->input->post('password'));
        // die();
        if ($this->input->post() == null) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = encrypt($this->input->post('password'));
            $cek_user = $this->db->query("SELECT * FROM user WHERE username='$username' and password='$password' ");
            if ($cek_user->num_rows() == 1) {
                foreach ($cek_user->result() as $row) {
                    $sess_data['id_user'] = $row->id_user;
                    $sess_data['nama'] = $row->nama;
                    $sess_data['username'] = $row->username;
                    $sess_data['level'] = 'admin';
                    $this->session->set_userdata($sess_data);
                }
                redirect('app');
            } else {
                ?>
				            <script type="text/javascript">
					               alert('Your Username and password are incorrect !');
					               window.location="<?php echo base_url('login/login'); ?>";
				             </script>
				        <?php
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        session_destroy();
        redirect('login/login');
    }

    public function email_read($uuid)
    {
        $get_date = $this->app_model->get_log_by_id($uuid);
        if (is_null($get_date->read_dt)) {
            $read = $this->app_model->update_read($uuid);
        }
        die();
    }
}
