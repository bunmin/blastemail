<?php
defined('BASEPATH') or exit('No direct script access allowed');

class app extends CI_Controller
{
    function __construct()
    {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('app_model');
      $this->load->model('emailgroup_model');
      $this->load->helper('url');

      if ($this->session->userdata('username') == "") {
        redirect('login/login');
      }
    }

    public function index()
    {
        $data = array(
            'konten' => 'compose/compose_single',
            'judul' => 'Compose Single Email',
        );
        $this->load->view('v_index', $data);
    }

    public function blastemail()
    {
        if ($this->session->userdata('username') == "") {
            redirect('login/login');
        }

        $group_list = $this->emailgroup_model->get_all_group();


        $data = array(
            'konten' => 'compose/compose_blast',
            'judul' => 'Compose Blast Email',
            'group_data' => $group_list,
        );
        $this->load->view('v_index', $data);
    }

    public function emailsinglesend()
    {
        $this->form_validation->set_rules('receiver', 'Receiver', 'trim|required');
        $this->form_validation->set_rules('cc', 'Cc', 'trim');
        $this->form_validation->set_rules('bcc', 'Bcc', 'trim');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('htmleditor', 'Message', 'trim|required');
        $this->form_validation->set_rules('sender_email', 'Sender Email', 'trim|required');
        $this->form_validation->set_rules('sender_name', 'Sender Name', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');


        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $this->load->config('email');
            $this->load->library('email');

            $from = $this->input->post('sender_email', true);
            $fromname = $this->input->post('sender_name', true);
            $cc = $this->input->post('cc', true);
            $bcc = $this->input->post('bcc', true);
            $subject = $this->input->post('subject', true);
            $message = $this->input->post('htmleditor');


            $receivers = explode(";", $this->input->post('receiver', true));
            $count_email = 0;
            foreach ($receivers as $receiver) {
                $uuid = $this->db->query("SELECT uuid() uuid")->row();
                $uuid = $uuid->uuid;

                $message = $message.'<img src="'.base_url().'login/email_read/'.$uuid.'" width="1" height="1">';

                $this->email->set_newline("\r\n");
                $this->email->from($from,$fromname);
                $this->email->to($receiver);
                $this->email->cc($cc);
                $this->email->bcc($bcc);
                $this->email->subject($subject);
                $this->email->message($message);

                if ($this->email->send()) {
                    $status = "Send Success";
                } else {
                    $status = "Send Failed :".show_error($this->email->print_debugger());
                }



                $data = array(
                    'uuid' => $uuid,
                    'receiver' => $receiver,
                    'cc' => $cc,
                    'bcc' => $bcc,
                    'subject' => $subject,
                    'message' => $message,
                    'status' => $status,
                );

                $this->app_model->insert_email_single($data);
                $count_email++;
            }

            $this->session->set_flashdata('flag', 'success');
            $this->session->set_flashdata('message', 'Success send to '.$count_email.' emails');
            redirect(site_url('app'));
        }
    }

    public function emailblastsend()
    {
        $this->form_validation->set_rules('group_email', 'Group Receiver', 'trim|required');
        $this->form_validation->set_rules('cc', 'Cc', 'trim');
        $this->form_validation->set_rules('bcc', 'Bcc', 'trim');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('htmleditor', 'Message', 'trim|required');
        $this->form_validation->set_rules('sender_email', 'Sender Email', 'trim|required');
        $this->form_validation->set_rules('sender_name', 'Sender Name', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');


        if ($this->form_validation->run() == false) {
            $this->blastemail();
        } else {
            $this->load->config('email');
            $this->load->library('email');

            $from = $this->input->post('sender_email', true);
            $fromname = $this->input->post('sender_name', true);
            $cc = $this->input->post('cc', true);
            $bcc = $this->input->post('bcc', true);
            $subject = $this->input->post('subject', true);
            $message = $this->input->post('htmleditor');
            $group_id = $this->input->post('group_email', true);

            $email_lists = $this->emailgroup_model->get_group_detail_by_id($group_id);
            $count_email = 0;
            foreach ($email_lists as $email_list) {
                $receiver = $email_list->email;

                $uuid = $this->db->query("SELECT uuid() uuid")->row();
                $uuid = $uuid->uuid;

                $message = $message.'<img src="'.base_url().'login/email_read/'.$uuid.'" width="1" height="1">';

                $this->email->set_newline("\r\n");
                $this->email->from($from,$fromname);
                $this->email->to($receiver);
                $this->email->cc($cc);
                $this->email->bcc($bcc);
                $this->email->subject($subject);
                $this->email->message($message);

                if ($this->email->send()) {
                    $status = "Send Success";
                } else {
                    $status = "Send Failed :".show_error($this->email->print_debugger());
                }

                $data = array(
                    'uuid' => $uuid,
                    'receiver' => $receiver,
                    'cc' => $cc,
                    'bcc' => $bcc,
                    'subject' => $subject,
                    'message' => $message,
                    'status' => $status,
                );

                $this->app_model->insert_email_single($data);
                $count_email++;
            }

            $this->session->set_flashdata('flag', 'success');
            $this->session->set_flashdata('message', 'Success send to '.$count_email.' emails');
            redirect(site_url('app/blastemail'));
        }
    }

    public function profiladmin($where,$id)
    {
        if ($_POST==null) {
            $d = $this->db->query("SELECT * from user where id_user='$id'")->row();
            $data = array(
                'rw' => $d,
                'konten' => 'profiladmin',
                'judul' => 'Data Profil',
            );
            $this->load->view('v_index', $data);
        } else {

            $this->form_validation->set_rules('nama','Nama','required');
            $this->form_validation->set_rules('username','Username','required|callback__unique_uname[user.id_user.'.$id.'.username]');

            if($this->form_validation->run() != false){
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'username' => $this->input->post('username'),
                    // 'password' => $this->input->post('password'),
                );

                $this->db->where('id_user', $id);
                $this->db->update('user', $data);

                $d = $this->db->query("SELECT * from user where id_user='$id'")->row();
                $data = array(
                    'rw' => $d,
                    'konten' => 'profiladmin',
                    'judul' => 'Data Profil',
                );

                if ($where=='profil') {
                  $this->session->set_flashdata('success', 'Berhasil ubah data !');
                  redirect('app/profiladmin/profil/'.$id);
                } elseif ($where=='list') {
                  $this->session->set_flashdata('flag', 'success');
                  $this->session->set_flashdata('message', 'Berhasil ubah data !');
                  redirect('user');
                }

            } else {
              $obj = new stdClass;
              $obj->id_user = $id;
              $obj->nama = $this->input->post('nama');
              $obj->username = $this->input->post('username');

              $data = array(
                  'rw' => $obj,
                  'konten' => 'profiladmin',
                  'judul' => 'Data Profil',
              );

              $this->load->view('v_index', $data);
            }

        }
    }

    public function ubahpass($id)
    {
        if ($_POST == null) {
            $data = array(
                'konten' => 'ubahpass',
                'judul' => 'Ubah password',
            );
            $this->load->view('v_index', $data);
        } else {
            $pass_lama = $this->input->post('pass_lama');
            $pass_baru = $this->input->post('pass_baru');
            $level = $this->session->userdata('level');

            if ($level == "admin") {
              $cek = $this->db->query("SELECT password FROM user where id_user='$id'")->row();
              if ($cek->password == md5($pass_lama)) {
                  $data = array(
                      'password' => md5($pass_baru)
                  );
                  $this->db->where('id_user', $id);
                  $this->db->update('user', $data);

                  ?>
  				            <script type="text/javascript">
  					               alert('Password Successfully replaced, please log in again!');
                           window.location="<?php echo base_url('login/logout'); ?>";
  				             </script>
  				        <?php
              } else {
                $this->session->set_flashdata('failed', 'Your old password is wrong');
                redirect('app/ubahpass/'.$id);
              }
            } else {
                  $data = array(
                      'konten' => 'ubahpass',
                      'judul' => 'Change Password',
                  );
                  $this->session->set_flashdata('failed', 'Your old password is wrong');
                  $this->load->view('v_index', $data);
            }
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
              $this->form_validation->set_message('_unique_uname', 'The username is already used.');
              return false;
            } else {
              return true;
            }
        }
    }
}
