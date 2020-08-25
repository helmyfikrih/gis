<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
            'datatables-bs4/css/dataTables.bootstrap4.min.css',
            'datatables-responsive/css/responsive.bootstrap4.min.css',
            'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'datepicker/css/bootstrap-datepicker.min.css',
            'select2/css/select2.min.css',
            'select2-bootstrap4-theme/select2-bootstrap4.min.css',
        );
        $this->plugins_path_js = array(
            'datatables/jquery.dataTables.min.js',
            'datatables-bs4/js/dataTables.bootstrap4.min.js',
            'datatables-responsive/js/dataTables.responsive.min.js',
            'datatables-responsive/js/responsive.bootstrap4.min.js',
            'sweetalert2/sweetalert2.min.js',
            'jquery-validation/jquery.validate.min.js',
            'jquery-validation/additional-methods.min.js',
            'moment/moment.min.js',
            'datepicker/js/bootstrap-datepicker.min.js',
            'select2/js/select2.full.min.js',
        );
        $this->js_path = array(
            'pages/users.js',
            'helper/date.js',
        );
        $data = array(
            'user_session' => $this->sessionData,
            'setting' => $this->systemSetting,
            'header_title' => "Users",
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'css_path' => $this->css_path,
            'js_path' => $this->js_path,
            'menu_body' => $this->menu_body,
            'menu_allow' => $this->data['menu_allow'],
            'user_allow_menu' => $this->data['user_allow_menu'],
            'select_role' => getSelectRole(),
        );
        if ((!in_array($this->data['menu_allow'] . '_read', $this->data['user_allow_menu']))) {
            $this->template->load('default', 'template/403', $data);
        } else {
            $this->template->load('default', 'users/index', $data);
        }
    }


    public function getList()
    {
        $cond = array(
            'user_status !=' => null
        );
        $list = $this->users->getList($cond);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            // $no++;
            $row = array();
            $btnEdit = "";
            $btnDelete = "";
            $btnView = "";

            if (array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
                $btnEdit = '<span><button type="button" class="btn btn-outline-info btn-sm" onclick="edit(\'' . ($field->user_id) . '\')"><i class="fa fa-edit"></i> Edit</button></span>';
            }
            if (array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
                $btnDelete = '<span><button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteData(\'' . ($field->user_id) . '\', \'' . ($field->user_username) . '\')"><i class="fa fa-trash"></i> Delete</button></span>';
            }
            $btnView = '<span><button type="button" class="btn btn-outline-success btn-sm" onclick="view(\'' . ($field->user_id) . '\')"><i class="fa fa-eye"></i> View</button></span>';
            $btn = " <div class='d-none d-sm-block d-sm-none d-md-block'>$btnEdit $btnView $btnDelete</div>";
            $btn .= "   <div class='input-group-prepend d-md-none d-lg-none d-xl-none '>
                          <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                          </button>
                          <div class='dropdown-menu'>
                            <div class='dropdown-item' href='javasctipy:;'>$btnEdit $btnView $btnDelete</div>
                          </div>
                        </div>";
            $row[] = $btn;
            $row[] = $field->user_id;
            $row[] = $field->user_username;
            $row[] = $field->user_email;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->users->count_new($cond),
            "recordsFiltered" => $this->users->count_filtered_new($cond),
            "data"            => $data,
        );
        //output dalam format JSON

        echo json_encode($output);
    }

    function save()
    {
        $this->load->helper("gis");
        $user_id = $this->input->post('user_id');
        $user_username = $this->input->post('user_username');
        $user_password = $this->input->post('user_password');
        $user_email = $this->input->post('user_email');
        $user_role = $this->input->post('user_role');
        $user_status = $this->input->post('user_status');
        $user_status = $this->input->post('user_status');
        $user_full_name = $this->input->post('user_full_name');
        $user_phone = $this->input->post('user_phone');
        $user_birth_date = $this->input->post('user_birth_date');
        $user_birth_place = $this->input->post('user_birth_place');
        $user_address = $this->input->post('user_address');
        $user_gender = $this->input->post('user_gender');
        $data['user'] = array(
            "user_username" => $user_username,
            "user_email" => $user_email,
            "role_id" => $user_role,
            "user_status" => $user_status,
        );
        $data['user_detail'] = array(
            "ud_full_name" => $user_full_name,
            "ud_gender" => $user_gender,
            "ud_address" => $user_address,
            "ud_birth_place" => $user_birth_place,
            "ud_birth_date" => date("Y-m-d", strtotime($user_birth_date)),
            "ud_phone" => $user_phone,
        );
        $cond = array(
            'user_id' => $user_id
        );
        $this->db->trans_begin();
        if ($user_id) {
            if ($user_password) {
                $data['user']['user_password'] = md5($user_password);
            }
            $data['user']['user_last_update'] = date("Y-m-d H:i:s");
            $data['user']['user_last_update_by'] = $this->session->userdata('logged_in')['user_id'];
            $data['user_detail']['ud_last_update'] = date("Y-m-d H:i:s");
            $data['user_detail']['ud_last_update_by'] = $this->session->userdata('logged_in')['user_id'];
            if (!array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
                $res = array(
                    'is_success' => false,
                    'message' => "User Tidak Memiliki Hak Akses",
                );
                echo json_encode($res);
                exit;
            } else {
                $this->users->updateUser($data['user'], $cond);
                if (isExistUserDetail($user_id)) {
                    $this->users->updateUserDetail($data['user_detail'], $cond);
                } else {
                    $data['user_detail']['user_id'] = $user_id;
                    $this->users->insertUserDetail($data['user_detail']);
                }
                $msg = "Berhasil Mengubah Data User";
            }
        } else {
            $data['user']['user_password'] = md5($user_password);
            $data['user']['user_created_date'] = date("Y-m-d H:i:s");
            $data['user']['user_created_by'] = $this->session->userdata('logged_in')['user_id'];
            $data['user_detail']['user_id'] = $user_id;
            if (!array_intersect(array($this->data['menu_allow'] . '_create'), $this->data['user_allow_menu'])) {
                $res = array(
                    'is_success' => false,
                    'message' => "User Tidak Memiliki Hak Akses",
                );
                echo json_encode($res);
                exit;
            } else {
                $this->users->insertUser($data['user']);
                $data['user_detail']['user_id'] = $this->db->insert_id();
                $this->users->insertUserDetail($data['user_detail']);
                $msg = "Berhasil Membuat User Baru";
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $err = $this->db->error();
            $msg = $err["code"] . "-" . $err["message"];
            $res = array(
                'is_success' => false,
                'message' =>  $msg
            );
        } else {
            $this->db->trans_commit();
            if ($user_id) {
                $res = array(
                    'is_success' => true,
                    'message' => "Berhasil Update Data User",
                );
            } else {
                $res = array(
                    'is_success' => true,
                    'message' => "Berhasil Membuat User Baru",
                );
            }
        }
        echo json_encode($res);
    }

    public function getOne()
    {
        $userId = $this->input->post('id');
        $data = $this->users->getOne($userId);
        echo json_encode($data);
    }

    function delete()
    {
        if (!array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
            $res = array(
                'is_success' => false,
                'message' => "User Tidak Memiliki Hak Akses",
            );
            echo json_encode($res);
            exit;
        }

        $user_id = $this->input->post('uid');
        $username = $this->input->post('uname');

        $data['cond'] = array(
            "user_id" => $user_id,
            "user_username" => $username,
        );

        if ($this->users->deleteData($data)) {
            $res = array(
                'is_success' => true,
                'message' => "Berhasil Menghapus User",
            );
        } else {
            $err = $this->db->error();
            $msg = $err["code"] . "-" . $err["message"];
            $res = array(
                'is_success' => false,
                'message' =>  $err
            );
        }
        echo json_encode($res);
    }
}
