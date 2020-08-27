<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Members_registration extends CI_Controller
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
        $this->load->model('register_model', 'register');
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
            redirect('home');
        }
    }

    public function index()
    {
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
            'pages/members_registration.js',
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
        );
        $this->template->load('default', 'members_registration/index', $data);
    }

    public function getList()
    {
        $cond = array();
        $list = $this->register->getList($cond);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            // $no++;
            $row = array();
            $btnEdit = "";
            $btnDelete = "";
            $btnView = "";

            if (array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
                $btnEdit = '<span><button type="button" class="btn btn-outline-info btn-sm" onclick="edit(\'' . ($field->register_id) . '\')"><i class="fa fa-edit"></i> Edit</button></span>';
            }
            if (array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
                $btnDelete = '<span><button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteData(\'' . ($field->register_id) . '\', \'' . ($field->register_email) . '\')"><i class="fa fa-trash"></i> Delete</button></span>';
            }
            $btnView = '<span><button type="button" class="btn btn-outline-success btn-sm" onclick="view(\'' . ($field->register_id) . '\', \'' . ($field->register_email) . '\')"><i class="fa fa-eye"></i> View</button></span>';
            $btn = " <div class='d-none d-sm-block d-sm-none d-md-block'>$btnEdit $btnView $btnDelete</div>";
            $btn .= "   <div class='input-group-prepend d-md-none d-lg-none d-xl-none '>
                          <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                          </button>
                          <div class='dropdown-menu'>
                            <div class='dropdown-item' href='javasctipy:;'>$btnEdit $btnView $btnDelete</div>
                          </div>
                        </div>";
            $status_email = '';
            $status_registration = '';
            if ($field->register_email_verify_status == 1) {
                $status_email = '<span class=" badge bg-success">Sudah Terverifikasi</span>';
            } else {
                $status_email = '<span class=" badge bg-warning">Menunggu Verifikasi</span>';
            }
            if ($field->register_status == 1) {
                $status_registration = '<span class=" badge bg-success">Sudah Terverifikasi</span>';
            } else if ($field->register_status == 0) {
                $status_registration = '<span class=" badge bg-danger">Ditolak</span>';
            } else {
                $status_registration = '<span class=" badge bg-warning">Menunggu Verifikasi</span>';
            }
            $row[] = $btn;
            $row[] = $status_registration;
            $row[] = $status_email;
            $row[] = $field->register_id;
            $row[] = $field->register_name;
            $row[] = $field->register_email;
            $row[] = $field->register_phone;
            $row[] = $field->register_address;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->register->count_new($cond),
            "recordsFiltered" => $this->register->count_filtered_new($cond),
            "data"            => $data,
        );
        //output dalam format JSON

        echo json_encode($output);
    }

    function getOne()
    {
        $register_id = $this->input->post('id');
        $register_email = $this->input->post('email');
        $cond = array(
            "r.register_id" => $register_id,
            "r.register_email" => $register_email,
        );
        $data = array(
            'data_register' => $this->register->getOne($cond),
            'data_register_attachment' => $this->register->getOneAttachment($cond),
        );
        echo json_encode($data);
    }

    function approval()
    {
        if (!array_intersect(array($this->data['menu_allow'] . '_approval'), $this->data['user_allow_menu'])) {
            $res = array(
                'is_success' => false,
                'message' => "User Tidak Memiliki Hak Akses",
            );
            echo json_encode($res);
            exit;
        }
        $approval = $this->input->post('approval');
        $email = $this->input->post('email');
        $code = $this->input->post('code');
        $cond = array(
            'register_uniq_code' => $code,
            'register_email' => $email,
            'register_status' => 2,
        );

        $getData = $this->register->getData($cond);
        $data['cond'] = array(
            'register_uniq_code' => $code,
            'register_email' => $email,
        );
        $this->db->trans_begin();
        if ($approval == 1 || $approval == '1') {

            $data['data_register'] = array(
                'register_status' => 1,
                'register_last_update' => date("Y-m-d H:i:s"),
                'register_last_update_by' => $this->session_data['user_id'],
            );
            $this->register->updateData($data);
            $message = "Terimakasih telah menunggu proses verifikasi pendaftaran anda. Selamat, pendaftaran anda diterima, silahkan gunakan credential yang digunakan pada saat registrasi untuk login.";
            $data['data_user'] = array(
                'role_id' => 3,
                'user_username' => $getData[0]['register_username'],
                'user_password' => $getData[0]['register_password'],
                'user_email' => $getData[0]['register_email'],
                'user_created_date' => $getData[0]['register_created_date'],
                'user_status' => 1,
            );
            $this->register->insertUser($data['data_user']);
            $user_id = $this->db->insert_id();
            $data['data_developer_detail'] = array(
                'kecamatan_id' => $getData[0]['kecamatan_id'],
                'user_id' => $user_id,
                'register_id' => $getData[0]['register_id'],
                'developer_name' => $getData[0]['register_name'],
                'developer_email' => $getData[0]['register_email'],
                'developer_phone' => $getData[0]['register_phone'],
                'developer_address' => $getData[0]['register_address'],
                'developer_lat' => $getData[0]['register_lat'],
                'developer_lng' => $getData[0]['register_lng'],
                'developer_since' => $getData[0]['register_since'],
                'developer_join_date' => date("Y-m-d H:i:s"),
                'developer_status' => 1,
            );
            $this->register->insertDeveloperDetail($data['data_developer_detail']);
        } else if ($approval == 0 || $approval = '0') {
            $data['data_register'] = array(
                'register_status' => 0,
                'register_last_update' => date("Y-m-d H:i:s"),
                'register_last_update_by' => $this->session_data['user_id'],
            );
            $this->register->updateData($data);
            $message = "Terimakasih telah menunggu proses verifikasi pendaftaran anda. Maaf, pendaftaran anda ditolak, silahkan hubungi kami untuk detail lebih lanjut.";
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->db->error();
            $res = array(
                'is_success' => false,
                'message' =>   $this->db->error()
            );
        } else {
            $this->db->trans_commit();

            $res = array(
                'is_success' => true,
                'message' => "Berhasil Melakukan Approval Pendafataran Anggota Baru.",
            );
            $this->load->helper('email');
            sendMail($getData[0]['register_email'], 'E-mail verification', $message);
        }
        echo json_encode($res);
    }
}
