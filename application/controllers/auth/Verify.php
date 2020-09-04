<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Verify extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', 'login');
    }

    function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('gis_uname', 'Username or E-mail', 'trim|required');
        $this->form_validation->set_rules('gis_password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('login_msg', 'Invalid username or password');
            redirect('auth/login?w=1', 'refresh');
        } else {
            redirect('home');
        }
    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('gis_uname');
        //query the database
        $result = $this->login->login($username, $password);
        if ($result) {
            $sess_array     = array();

            foreach ($result as $row) {
                $sess_array = array(
                    'user_id'             => $row->user_id,
                    'username'     => $row->user_username,
                    'role_id'        => $row->role_id,
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }
}
