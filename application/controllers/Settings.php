<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->plugins_path_css = array();
        $this->plugins_path_js = array();
        $this->css_path = array();
        $this->js_path = array();
        $this->session_data = $this->session->userdata('logged_in');
        $this->menu_body = $this->menu->getmenu($this->session_data['user_id'], $this->session_data['username']);
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->sessionData = getSessionData();
        $this->systemSetting = getSystemSetting();
        // Model
        $this->load->model('settings_model', 'setting');
        // Menu Access Role
        $urlname    = strtolower($this->router->fetch_class());
        $menu_id       = $this->menu->idMenu($urlname);
        $user_allow = $this->menu->UserAllow($this->session_data['role_id']);
        $user_allow_menu = explode(",", $user_allow[0]['role_allow_menu']);
        $this->data['menu_allow'] = '';
        $this->data['user_allow_menu'] = $user_allow_menu;
        if (@in_array($menu_id[0]['menu_id'], $user_allow_menu)) {
            $this->data['menu_allow'] = 'level_' . $menu_id[0]['menu_id'];
        } else {
            redirect('home', 'refresh');
        }
    }
    public function index()
    {
        $this->plugins_path_css = array(
            'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        );
        $this->plugins_path_js = array(
            'sweetalert2/sweetalert2.min.js',
            'jquery-validation/jquery.validate.min.js',
            'jquery-validation/additional-methods.min.js',
        );
        $this->js_path = array(
            'pages/settings.js',
        );
        $data = array(
            'user_session' => $this->sessionData,
            'setting' => $this->systemSetting,
            'header_title' => "System Settings",
            'css_path' => $this->css_path,
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'js_path' => $this->js_path,
            'menu_body' => $this->menu_body,
        );
        $this->template->load('default', 'settings/index', $data);
    }

    function saveGeneral()
    {
        $application_name = $this->input->post('application_name');
        $application_about = $this->input->post('application_about');
        $header_name = $this->input->post('header_name');
        $footer_text = $this->input->post('footer_text');
        $footer_year = $this->input->post('footer_year');
        $data = array(
            'system_settings_id' => 1,
            'system_settings_app_name' => $application_name,
            'system_settings_app_about' => $application_about,
            'system_settings_app_header_text' => $header_name,
            'system_settings_app_footer_text' => $footer_text,
            'system_settings_app_footer_year' => $footer_year,
        );

        if ($this->setting->updateSetting($data)) {
            $res = array(
                'is_success' => true,
                'message' => "Berhasil Menyimpan Perubahan",
            );
        } else {
            $res = array(
                'is_success' => false,
                'message' =>  $this->db->error()
            );
        }
        echo json_encode($res);
    }

    public function saveLogo()
    {
        // print_r($_FILES);
        // die;
        $logo_header = $_FILES['system_settings_app_logo_header'];
        $logo_icon = $_FILES['system_settings_app_logo_icon'];
        $res = array(
            'is_success' => false,
            'message' => $this->lang->line('warning_no_file_choosen')
        );
        if ($logo_header['error'] == 0) {
            $res = $this->uploadImg('logo', 'system_settings_app_logo_header');
        }
        if ($logo_icon['error'] == 0) {
            $res = $this->uploadImg('icon', 'system_settings_app_logo_icon');
        }
        echo json_encode($res);
    }

    function uploadImg($nmFile, $inputFile)
    {
        $config['upload_path'] = './assets/dist/img/';
        $config['allowed_types'] = 'jpg|png|PNG';
        $config['overwrite'] = TRUE;
        $config['max_size']     = '2000';
        $config['file_name'] = $nmFile;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($inputFile)) {
            $res = array(
                'is_success' => false,
                'message' => $this->upload->display_errors()
            );
            return $res;
        } else {
            //Image Resizing
            $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 128;
            $config['height'] = 128;
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize()) {
                $res = array(
                    'is_success' => false,
                    'message' => $this->image_lib->display_errors('', '')
                );
                return $res;
            } else {
                $data = array(
                    $inputFile => $this->upload->file_name
                );
                $this->setting->updateSetting($data);
                $res = array(
                    'is_success' => true,
                    'message' => "Berhasil Menyimpan Perubahan",
                    'imgType' => $inputFile
                );
            }

            return $res;
        }
    }

    public function saveSMTP()
    {
        $sys_smtp_host = $this->input->post('sys_smtp_host');
        $sys_smtp_user = $this->input->post('sys_smtp_user');
        $sys_smtp_pass = $this->input->post('sys_smtp_pass');
        $sys_smtp_crypto = $this->input->post('sys_smtp_crypto');
        $sys_smtp_port = $this->input->post('sys_smtp_port');
        $sys_smtp_from = $this->input->post('sys_smtp_from');
        $sys_smtp_alias = $this->input->post('sys_smtp_alias');
        $data = array(
            'system_settings_smtp_host' => $sys_smtp_host,
            'system_settings_smtp_user' => $sys_smtp_user,
            'system_settings_smtp_password' => $sys_smtp_pass,
            'system_settings_smtp_crypto' => $sys_smtp_crypto,
            'system_settings_smtp_port' => $sys_smtp_port,
            'system_settings_smtp_from' => $sys_smtp_from,
            'system_settings_smtp_alias' => $sys_smtp_alias,
        );


        if ($this->setting->updateSetting($data)) {
            $res = array(
                'is_success' => true,
                'message' => "Berhasil Menyimpan Perubahan",
            );
        } else {
            $err = $this->db->error();
            $msg = $err["code"] . "-" . $err["message"];
            $res = array(
                'is_success' => false,
                'message' =>  $msg
            );
        }

        echo json_encode($res);
    }
}
