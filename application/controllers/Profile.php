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
        $this->systemSetting = getSystemSetting();
        // Model
        $this->load->model('profile_model', 'profile');
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
            'croppie/css/croppie.css',
        );
        $this->plugins_path_js = array(
            'sweetalert2/sweetalert2.min.js',
            'jquery-validation/jquery.validate.min.js',
            'jquery-validation/additional-methods.min.js',
            'moment/moment.min.js',
            'datepicker/js/bootstrap-datepicker.min.js',
            'select2/js/select2.full.min.js',
            'croppie/js/croppie.min.js',
        );
        $this->js_path = array(
            'pages/profile.js',
            'helper/date.js',
        );
        $data = array(
            'user_session' => $this->sessionData,
            'setting' => $this->systemSetting,
            'header_title' => "Profile",
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

    function saveChangePassword()
    {
        $password_old = $this->input->post('password_old');
        $password = $this->input->post('password');
        $password_confirm = $this->input->post('password_confirm');
        $data['cond'] = array(
            'u.user_id' => $this->sessionData->user_id,
        );
        $password_current = $this->profile->getUserDetail($data)->result_array()[0]['user_password'];
        if ($password_current != md5($password_old)) {
            $res = array(
                'is_success' => false,
                'message' => "Password Lama Tidak Sesuai",
            );
            echo json_encode($res);
            exit;
        }
        if ($password != $password_confirm) {
            $res = array(
                'is_success' => false,
                'message' => "Password Tidak Sama",
            );
            echo json_encode($res);
            exit;
        }
        $data['data_user'] = array(
            'user_password' => md5($password),
        );
        if ($this->profile->update($data)) {
            $res = array(
                'is_success' => true,
                'message' => "Password Berhasil Diubah",
            );
        } else {
            $res = array(
                'is_success' => false,
                'message' => $this->db->error(),
            );
        }
        echo json_encode($res);
    }

    function saveProfile()
    {
        $username_old = $this->input->post('username_old');
        $username = $this->input->post('username');
        $email_old = $this->input->post('email_old');
        $email = $this->input->post('email');
        $full_name = $this->input->post('full_name');
        $birth_place = $this->input->post('birth_place');
        $birth_date = $this->input->post('birth_date');
        $address = $this->input->post('address');
        $user_gender = $this->input->post('user_gender');
        $phone_number = $this->input->post('phone_number');
        $data['cond'] = array(
            'u.user_id' => $this->sessionData->user_id,
        );
        // $username_current = $this->profile->getUserDetail($data)->result_array()[0]['user_username'];
        if ($username_old != $username) {
            if (isExistUsername(trim($username))) {
                $res = array(
                    'is_success' => false,
                    'message' => "Username Tidak Tersedia",
                );
                echo json_encode($res);
                exit;
            }
        }
        // $email_current = $this->profile->getUserDetail($data)->result_array()[0]['user_username'];
        if ($email_old != $email) {
            if (isExisEmail(trim($username))) {
                $res = array(
                    'is_success' => false,
                    'message' => "E-mail Tidak Tersedia",
                );
                echo json_encode($res);
                exit;
            }
        }
        $data['data_user'] = array(
            "user_username" => $username,
            "user_email" => $email,
            "user_last_update" => date("Y-m-d H:i:s"),
            "user_last_update_by" => $this->sessionData->user_id,
        );
        $data['data_user_detail'] = array(
            "ud_full_name" => $full_name,
            "ud_gender" => $user_gender,
            "ud_address" => $address,
            "ud_birth_place" => $birth_place,
            "ud_birth_date" => date("Y-m-d", strtotime($birth_date)),
            "ud_phone" => $phone_number,
        );
        $data['cond'] = array(
            'user_id' => $this->sessionData->user_id,
        );
        $this->db->trans_begin();
        $this->profile->updateUser($data);
        if (isExistUserDetail($this->sessionData->user_id)) {
            $this->profile->updateUserDetail($data);
        } else {
            $this->profile->insertUserDetail($data);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res = array(
                'is_success' => false,
                'message' =>   $this->db->error()
            );
        } else {
            $this->db->trans_commit();
            $res = array(
                'is_success' => true,
                'message' => "Berhasil Update Profile",
            );
        }
        echo json_encode($res);
    }

    function saveChangeAvatar()
    {
        $img = $_POST["image"];
        $image_array_1 = explode(";", $img);

        $image_array_2 = explode(",", $image_array_1[1]);
        $extension = explode('/', mime_content_type($img))[1];
        $path = "assets/uploads/images/avatar/";
        $img = base64_decode($image_array_2[1]);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $imageName = $this->sessionData->user_id . '_' . $this->sessionData->user_username . '.' . $extension;
        $imagePath = $path . $imageName;
        if (file_put_contents($imagePath, $img)) {
            $data['data_user_detail'] = array(
                "ud_img_name" =>  $imageName,
                "ud_img_url" =>  base_url() . $imagePath,
            );
            $data['cond'] = array(
                'user_id' => $this->sessionData->user_id,
            );
            if ($this->profile->updateUserDetail($data)) {
                $res = array(
                    'is_success' => true,
                    'message' => "Berhasil Ubah Avatar",
                );
            } else {
                $res = array(
                    'is_success' => false,
                    'message' =>   $this->db->error()
                );
            }
        } else {
            $res = array(
                'is_success' => false,
                'message' =>   "Gagal Ubah Avatar"
            );
        }
        echo json_encode($res);
    }
}
