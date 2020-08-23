<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_role extends CI_Controller
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
        // Model
        $this->load->model('user_role_model', 'role');
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
            'datatables-bs4/css/dataTables.bootstrap4.min.css',
            'datatables-responsive/css/responsive.bootstrap4.min.css',
            'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        );
        $this->plugins_path_js = array(
            'datatables/jquery.dataTables.min.js',
            'datatables-bs4/js/dataTables.bootstrap4.min.js',
            'datatables-responsive/js/dataTables.responsive.min.js',
            'datatables-responsive/js/responsive.bootstrap4.min.js',
            'sweetalert2/sweetalert2.min.js',
            'jquery-validation/jquery.validate.min.js',
            'jquery-validation/additional-methods.min.js',
        );
        $this->js_path = array(
            'pages/user_role.js',

        );
        $data = array(
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'css_path' => $this->css_path,
            'js_path' => $this->js_path,
            'menu_body' => $this->menu_body,
            'menuakses' => $this->getmenulist(),
            'menu_allow' => $this->data['menu_allow'],
            'user_allow_menu' => $this->data['user_allow_menu'],
        );
        if ((!in_array($this->data['menu_allow'] . '_read', $this->data['user_allow_menu']))) {
            $this->template->load('default', 'template/403', $data);
        } else {
            $this->template->load('default', 'user_role/index', $data);
        }
    }

    function getmenulist()
    {
        $menu = $this->menu->getmenujson();
        return $menu;
    }


    public function getList()
    {
        $cond = array(
            'role_status !=' => null
        );
        $list = $this->role->getList($cond);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            // $no++;
            $row = array();
            $btnEdit = "";
            $btnDelete = "";

            if (array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
                $btnEdit = '<span><button type="button" class="btn btn-outline-info btn-sm" onclick="edit(\'' . ($field->role_id) . '\')" title="' . $this->lang->line('role_edit') . '"><i class="fa fa-edit"></i> Edit</button></span>';
            }
            if (array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
                $btnDelete = '<span><button type="button" class="btn btn-outline-info btn-sm" onclick="edit(\'' . ($field->role_id) . '\')" title="' . $this->lang->line('role_edit') . '"><i class="fa fa-edit"></i> Edit</button></span>';
            }

            $btn = " $btnEdit $btnDelete";
            $row[] = $btn;
            $row[] = $field->role_id;
            $row[] = $field->role_code;
            $row[] = $field->role_name;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->role->count_new($cond),
            "recordsFiltered" => $this->role->count_filtered_new($cond),
            "data"            => $data,
        );
        //output dalam format JSON

        echo json_encode($output);
    }

    function save()
    {
        $insert = "";
        $update = "";
        $roleId = $this->input->post('role_id');
        $roleCode = $this->input->post('role_code');
        $roleName = $this->input->post('role_name');
        $roleAllowMenu = implode(",", $this->input->post('role_allow_menu'));
        $data = array(
            'role_code' => $roleCode,
            'role_name' => $roleName,
            'role_allow_menu' => $roleAllowMenu
        );
        $cond = array(
            'role_id' => $roleId
        );
        $data['role_created_date'] = date("Y-m-d H:i:s");
        $data['role_created_by'] = $this->session->userdata('logged_in')['role_id'];
        $data['role_status'] = 1;
        if ($roleId) {
            if (!array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
                $res = array(
                    'is_success' => false,
                    'message' => $this->lang->line('warning_access'),
                );
                echo json_encode($res);
                exit;
            } else {
                $update = $this->role->updatetRole($data, $cond);
                $msg = "Berhasil Mengubah Role";
            }
        } else {
            if (!array_intersect(array($this->data['menu_allow'] . '_create'), $this->data['user_allow_menu'])) {
                $res = array(
                    'is_success' => false,
                    'message' => $this->lang->line('warning_access'),
                );
                echo json_encode($res);
                exit;
            } else {
                $insert = $this->role->insertRole($data);
                $msg = "Berhasil Membuat Role";
            }
        }

        if ($insert || $update) {
            $res = array(
                'is_success' => true,
                'message' => $msg,
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

    public function getOne()
    {
        $roleId = $this->input->post('id');
        $data = $this->role->getOne($roleId);
        echo json_encode($data);
    }
}
