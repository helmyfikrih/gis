<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
        // Model
        $this->load->model('users_model', 'users');
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
        $this->load->helper('select');
        $this->plugins_path_css = array(
            'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'datepicker/css/bootstrap-datepicker.min.css',
            'select2/css/select2.min.css',
            'select2-bootstrap4-theme/select2-bootstrap4.min.css',
        );
        $this->plugins_path_js = array(
            'sweetalert2/sweetalert2.min.js',
            'jquery-validation/jquery.validate.min.js',
            'jquery-validation/additional-methods.min.js',
            'moment/moment.min.js',
            'datepicker/js/bootstrap-datepicker.min.js',
            'select2/js/select2.full.min.js',
        );
        $this->js_path = array(
            'pages/profile.js',
            'helper/date.js',
        );
        $data = array(
            'user_session' => $this->sessionData,
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'css_path' => $this->css_path,
            'js_path' => $this->js_path,
            'menu_body' => $this->menu_body,
            'menu_allow' => $this->data['menu_allow'],
            'user_allow_menu' => $this->data['user_allow_menu'],
            'select_role' => getSelectRole(),
        );

        $this->template->load('default', 'profile/index', $data);
    }
}
