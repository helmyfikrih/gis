<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portofolio extends CI_Controller
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
		$this->load->model('portofolio_model', 'anggota');
		$this->load->model('users_model', 'user');
		$this->load->model('portofolio_model', 'register');
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
			'pages/portofolio/anggota.js',
			'helper/date.js',
		);
		$data = array(
			'user_session' => $this->sessionData,
			'setting' => $this->systemSetting,
			'header_title' => "Portofolio",
			'plugins_path_css' => $this->plugins_path_css,
			'plugins_path_js' => $this->plugins_path_js,
			'css_path' => $this->css_path,
			'js_path' => $this->js_path,
			'menu_body' => $this->menu_body,
			'menu_allow' => $this->data['menu_allow'],
			'user_allow_menu' => $this->data['user_allow_menu'],
		);
		$this->template->load('default', 'portofolio/index', $data);
	}

	public function getList()
	{
		$cond = array(
			'u.role_id' => 3,
			'developer_portofolio_id IS NOT NULL' => null
		);
		$list = $this->anggota->getList($cond);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			// $no++;
			$row = array();
			$btnEdit = "";
			$btnDelete = "";
			$btnView = "";

			if (array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
				$btnEdit = '<span><a class="btn btn-outline-info btn-sm" href="' . base_url('portofolio/edit/') . $field->developer_portofolio_id . '/' . urlencode($field->developer_portofolio_email) . '"><i class="fa fa-edit"></i> Edit</a></span>';
			}
			if (array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
				$btnDelete = '<span><button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteData(\'' . ($field->user_id) . '\', \'' . ($field->developer_portofolio_id) . '\')"><i class="fa fa-trash"></i> Delete</button></span>';
			}
			$btnView = '<span><button type="button" class="btn btn-outline-success btn-sm" onclick="view(\'' . ($field->developer_portofolio_id) . '\', \'' . ($field->developer_portofolio_email) . '\')"><i class="fa fa-eye"></i> View</button></span>';
			$btn = " <div class='d-none d-sm-block d-sm-none d-md-block'>$btnEdit $btnView $btnDelete</div>";
			$btn .= "   <div class='input-group-prepend d-md-none d-lg-none d-xl-none '>
                          <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                          </button>
                          <div class='dropdown-menu'>
                            <div class='dropdown-item' href='javasctipy:;'>$btnEdit $btnView $btnDelete</div>
                          </div>
                        </div>";
			$status_dev = '';
			if ($field->developer_portofolio_status == 1) {
				$status_dev = '<span class=" badge bg-success">Aktif</span>';
			} else if ($field->developer_portofolio_status == 0) {
				$status_dev = '<span class=" badge bg-danger">Tidak Aktif</span>';
			} else if ($field->developer_portofolio_status == 2) {
				$status_dev = '<span class=" badge bg-info">Menunggu Validasi</span>';
			} else {
				$status_dev = '<span class=" badge bg-warning">Unknown</span>';
			}
			$row[] = $btn;
			$row[] = $status_dev;
			$row[] = $field->developer_portofolio_name;
			$row[] = $field->developer_portofolio_email;
			$row[] = $field->developer_portofolio_phone;
			$row[] = $field->developer_portofolio_address;
			$data[] = $row;
		}

		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->anggota->count_new($cond),
			"recordsFiltered" => $this->anggota->count_filtered_new($cond),
			"data"            => $data,
		);
		//output dalam format JSON

		echo json_encode($output);
	}

	function create()
	{
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
			'pages/portofolio/create.js',
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
			'select_kota' => getSelectKota(),
			'select_kategori' => getSelectKategori(),
			'menu_allow' => $this->data['menu_allow'],
			'user_allow_menu' => $this->data['user_allow_menu'],
		);
		$this->template->load('default', 'portofolio/create', $data);
	}

	function getOne()
	{
		$developer_id = $this->input->post('id');
		$developer_email = $this->input->post('email');
		$cond = array(
			"p.developer_portofolio_id" => $developer_id,
			"p.developer_portofolio_email" => $developer_email,
		);
		$data = array(
			'data_register' => $this->anggota->getOne($cond),
		);
		echo json_encode($data);
	}

	function getData()
	{
		$developer_id = $this->input->post('id');
		$cond = array(
			"developer_id" => $developer_id,
		);
		$data = array(
			'data' => $this->anggota->getData($cond),
		);
		echo json_encode($data);
	}

	public function save()
	{
		$this->load->library('form_validation');
		$date_time = date("Y-m-d H:i:s");
		$this->form_validation->set_rules(
			'phone',
			'Nomor Telepon',
			'trim|required|min_length[5]|max_length[20]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => '%s sudah terdaftar.'
			)
		);
		if ($this->form_validation->run() == FALSE) {
			$res =  array(
				'is_success' => false,
				'message' => validation_errors()
			);
			echo json_encode($res);
			exit;
		}
		$portofolio_name = $this->input->post('portofolio_name');
		$portofolio_address = $this->input->post('address');
		$portofolio_email = $this->input->post('portofolio_email');
		$portofolio_start_date = $this->input->post('portofolio_start_date');
		$portofolio_end_date = $this->input->post('portofolio_end_date');
		$portofolio_lat = $this->input->post('loc_lat');
		$portofolio_lng = $this->input->post('loc_lng');
		$portofolio_phone = $this->input->post('phone');
		$data['portofolio'] = array(
			'developer_id' => $this->sessionData->developer_id ? $this->sessionData->developer_id : 1,
			'developer_portofolio_name' => $portofolio_name,
			'developer_portofolio_address' => $portofolio_address,
			'developer_portofolio_phone' => $portofolio_phone,
			'developer_portofolio_email' => $portofolio_email,
			'developer_portofolio_build_date_start' => $portofolio_start_date,
			'developer_portofolio_build_date_end' => $portofolio_end_date,
			'developer_portofolio_created_date' => date("Y-m-d H:i:s"),
			'developer_portofolio_created_by' => $this->sessionData->user_id,
			'developer_portofolio_lat' => $portofolio_lat,
			'developer_portofolio_lng' => $portofolio_lng,
			'developer_portofolio_status' => 2,
		);
		$this->db->trans_begin();

		$this->anggota->insertPortofolioDetail($data['portofolio']);
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
			$res = array(
				'is_success' => true,
				'message' => "Berhasil Menambahkan Portofolio Baru.",
			);
		}
		echo json_encode($res);
	}

	public function save_edit()
	{
		// print_r($_FILES);
		// die;
		$this->load->library('form_validation');
		$date_time = date("Y-m-d H:i:s");
		if ($this->input->post('old_email') != $this->input->post('portofolio_email')) {
			$this->form_validation->set_rules(
				'email',
				'Email',
				'required|min_length[5]|max_length[45]|is_unique[gis_user.user_email]|is_unique[gis_developer_portofolio.developer_portofolio_email]',
				array(
					'required'      => 'You have not provided %s.',
					'is_unique'     => '%s sudah terdaftar.'
				)
			);
			if ($this->form_validation->run() == FALSE) {
				$res =  array(
					'is_success' => false,
					'message' => validation_errors()
				);
				echo json_encode($res);
				exit;
			}
		}

		$user_id = $this->input->post('user_id');
		$uniqid = uniqid('gis_', true);
		$portofolio_id = $this->input->post('developer_portofolio_id');
		$portofolio_name = $this->input->post('portofolio_name');
		$portofolio_address = $this->input->post('address');
		$portofolio_email = $this->input->post('portofolio_email');
		$portofolio_start_date = $this->input->post('portofolio_start_date');
		$portofolio_end_date = $this->input->post('portofolio_end_date');
		$portofolio_lat = $this->input->post('loc_lat');
		$portofolio_lng = $this->input->post('loc_lng');
		$portofolio_phone = $this->input->post('phone');
		$data['portofolio'] = array(
			'developer_id' => $this->sessionData->developer_id ? $this->sessionData->developer_id : 1,
			'developer_portofolio_name' => $portofolio_name,
			'developer_portofolio_address' => $portofolio_address,
			'developer_portofolio_phone' => $portofolio_phone,
			'developer_portofolio_email' => $portofolio_email,
			'developer_portofolio_build_date_start' => $portofolio_start_date,
			'developer_portofolio_build_date_end' => $portofolio_end_date,
			'developer_portofolio_last_update' => date("Y-m-d H:i:s"),
			'developer_portofolio_last_update_by' => $this->sessionData->user_id,
			'developer_portofolio_lat' => $portofolio_lat,
			'developer_portofolio_lng' => $portofolio_lng,
			'developer_portofolio_status' => 2,
		);

		$this->db->trans_begin();
		$this->anggota->update($data['portofolio'], array(
			'developer_portofolio_id' => $portofolio_id,
		), 'gis_developer_portofolio');
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
			$res = array(
				'is_success' => true,
				'message' => "Berhasil Mengubah Data.",
			);
		}
		// $this->load->helper('email');
		// $url = base_url('auth/register/verify/' . $uniqid . '/' . $portofolio_username);
		// $message = "Hi $portofolio_name, <br> Terimakasih Telah Melakukan Registrasi.<br><br>Silahkan klik verifikasi untuk mengaktifkan akun anda.<br/>
		// <a href='$url'>Verifikasi</a>";
		// // $message = $this->load->view('template/email', $text, TRUE);
		// sendMail($portofolio_email, 'E-mail verification', $message);
		echo json_encode($res);
	}

	public function edit($developer_id = null, $developer_email = null)
	{
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
			'pages/portofolio/edit.js',
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
			'select_kota' => getSelectKota(),
			'select_kategori' => getSelectKategori(),
			'menu_allow' => $this->data['menu_allow'],
			'user_allow_menu' => $this->data['user_allow_menu'],
		);
		$developer_email = urldecode($developer_email);
		$cond = array(
			"p.developer_portofolio_id" => $developer_id,
			"p.developer_portofolio_email" => $developer_email,
		);
		$data['data_edit'] = $this->anggota->getOne($cond);
		$this->template->load('default', 'portofolio/edit', $data);
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

		$user_id = $this->input->post('user_id');
		$portofolio_id = $this->input->post('portofolio_id');
		$this->db->trans_begin();
		$this->anggota->deleteData(array(
			"developer_portofolio_id" => $portofolio_id,
		), 'gis_developer_portofolio');
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
			$res = array(
				'is_success' => true,
				'message' => "Berhasil Menghapus Data.",
			);
		}
		echo json_encode($res);
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
        $id = $this->input->post('id');
        $cond = array(
            'developer_portofolio_id' => $id,
            'developer_portofolio_email' => $email,
            'developer_portofolio_status' => 2,
        );

        $getData = $this->register->getData($cond);
        if ($approval == 1 || $approval == '1') {
			$data['portofolio'] = array(
				'developer_portofolio_status' => 1,
			);
			$this->anggota->update($data['portofolio'], $cond, 'gis_developer_portofolio');
        } else if ($approval == 0 || $approval = '0') {
			$data['portofolio'] = array(
				'developer_portofolio_status' => 0,
			);
			$this->anggota->update($data['portofolio'], $cond, 'gis_developer_portofolio');
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
                'message' => "Berhasil Melakukan Approval.",
            );
        }
        echo json_encode($res);
    }
}
