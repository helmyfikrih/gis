<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_kecamatan extends CI_Controller
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
        $this->load->model('data_kecamatan_model', 'kecamatan');
        // Menu Access Role
        $urlname    = strtolower($this->router->fetch_class());
        $menu_id       = $this->menu->idMenu($urlname);
        $user_allow = $this->menu->UserAllow($this->session_data['user_id']);
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
            'select2/js/select2.full.min.js',
        );
        $this->js_path = array(
            'pages/data_kecamatan.js',

        );
        $this->load->helper('select');
        $data = array(
            'user_session' => $this->sessionData,
            'setting' => $this->systemSetting,
            'header_title' => "User Roles",
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'css_path' => $this->css_path,
            'js_path' => $this->js_path,
            'menu_body' => $this->menu_body,
            'menuakses' => $this->getmenulist(),
            'menu_allow' => $this->data['menu_allow'],
            'user_allow_menu' => $this->data['user_allow_menu'],
            'select_kota' => getSelectKota(),
        );
        if ((!in_array($this->data['menu_allow'] . '_read', $this->data['user_allow_menu']))) {
            $this->template->load('default', 'template/403', $data);
        } else {
            $this->template->load('default', 'data_kecamatan/index', $data);
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
            // 'role_status !=' => null
        );
        $list = $this->kecamatan->getList($cond);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            // $no++;
            $row = array();
            $btnEdit = "";
            $btnDelete = "";

            if (array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
                $btnEdit = '<span><button type="button" class="btn btn-outline-info btn-sm" onclick="edit(\'' . ($field->kecamatan_id) . '\')"><i class="fa fa-edit"></i> Edit</button></span>';
            }
            if (array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
                $btnDelete = '<span><button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteData(\'' . ($field->kecamatan_id) . '\',\'' . ($field->kecamatan_code) . '\')"><i class="fa fa-trash"></i> Delete</button></span>';
            }

            $btn = " <div class='d-none d-sm-block d-sm-none d-md-block'>$btnEdit $btnDelete</div>";
            $btn .= "   <div class='input-group-prepend d-md-none d-lg-none d-xl-none'>
                          <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                          </button>
                          <div class='dropdown-menu'>
                            <div class='dropdown-item' href='javasctipy:;'>$btnEdit $btnDelete</div>
                          </div>
                        </div>";
            $row[] = $btn;
            $row[] = $field->kecamatan_id;
            $row[] = $field->kecamatan_code;
            $row[] = $field->kecamatan_name;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->kecamatan->count_new($cond),
            "recordsFiltered" => $this->kecamatan->count_filtered_new($cond),
            "data"            => $data,
        );
        //output dalam format JSON

        echo json_encode($output);
    }

    function save()
    {
        $insert = "";
        $update = "";
        $kecamatanId = $this->input->post('kecamatan_id');
        $kotaId = $this->input->post('kota_id');
        $kecamatanCode = $this->input->post('kecamatan_code');
        $kecamatanName = $this->input->post('kecamatan_name');
        $data = array(
            'kota_id' => $kotaId,
            'kecamatan_code' => $kecamatanCode,
            'kecamatan_name' => strtolower($kecamatanName),
        );
        $cond = array(
            'kecamatan_id' => $kecamatanId
        );
        if ($kecamatanId) {
            if (!array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
                $res = array(
                    'is_success' => false,
                    'message' => $this->lang->line('warning_access'),
                );
                echo json_encode($res);
                exit;
            } else {
                $update = $this->kecamatan->update($data, $cond);
                $msg = "Berhasil Mengubah Kecamatan";
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
                $insert = $this->kecamatan->insert($data);
                $msg = "Berhasil Membuat Kecamatan";
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
        $kecamatanId = $this->input->post('id');
        $data = $this->kecamatan->getOne($kecamatanId);
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

        $kecamatan_id = $this->input->post('rid');
        $kecamatan_code = $this->input->post('rcode');

        $data['cond'] = array(
            "kecamatan_id" => $kecamatan_id,
            "kecamatan_code" => $kecamatan_code,
        );

        if ($this->kecamatan->deleteData($data)) {
            $res = array(
                'is_success' => true,
                'message' => "Berhasil Menghapus Kecamatan",
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
