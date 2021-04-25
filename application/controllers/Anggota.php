<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
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
		$this->load->model('anggota_model', 'anggota');
		$this->load->model('users_model', 'user');
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
			'pages/anggota/anggota.js',
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
		$this->template->load('default', 'anggota/index', $data);
	}

	public function getList()
	{
		$cond = array(
			'u.role_id' => 3
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
				$btnEdit = '<span><a class="btn btn-outline-info btn-sm" href="' . base_url('anggota/edit/') . $field->developer_id . '/' . urlencode($field->developer_email) . '"><i class="fa fa-edit"></i> Edit</a></span>';
			}
			if (array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
				$btnDelete = '<span><button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteData(\'' . ($field->user_id) . '\', \'' . ($field->register_id) . '\')"><i class="fa fa-trash"></i> Delete</button></span>';
			}
			$btnView = '<span><button type="button" class="btn btn-outline-success btn-sm" onclick="view(\'' . ($field->developer_id) . '\', \'' . ($field->developer_email) . '\')"><i class="fa fa-eye"></i> View</button></span>';
			$btn = " <div class='d-none d-sm-block d-sm-none d-md-block'>$btnEdit $btnView $btnDelete</div>";
			$btn .= "   <div class='input-group-prepend d-md-none d-lg-none d-xl-none '>
                          <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                          </button>
                          <div class='dropdown-menu'>
                            <div class='dropdown-item' href='javasctipy:;'>$btnEdit $btnView $btnDelete</div>
                          </div>
                        </div>";
			$status_dev = '';
			if ($field->developer_status == 1) {
				$status_dev = '<span class=" badge bg-success">Aktif</span>';
			} else if ($field->developer_status == 0) {
				$status_dev = '<span class=" badge bg-danger">Tidak Aktif</span>';
			} else {
				$status_dev = '<span class=" badge bg-warning">Unknown</span>';
			}
			$row[] = $btn;
			$row[] = $status_dev;
			$row[] = $field->developer_name;
			$row[] = $field->developer_email;
			$row[] = $field->developer_phone;
			$row[] = $field->developer_address;
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
			'pages/anggota/create.js',
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
			'menu_allow' => $this->data['menu_allow'],
			'user_allow_menu' => $this->data['user_allow_menu'],
		);
		$this->template->load('default', 'anggota/create', $data);
	}

	function getOne()
	{
		$developer_id = $this->input->post('id');
		$developer_email = $this->input->post('email');
		$cond = array(
			"dd.developer_id" => $developer_id,
			"dd.developer_email" => $developer_email,
		);
		$data = array(
			'data_register' => $this->anggota->getOne($cond),
			'data_register_attachment' => $this->anggota->getOneAttachment($cond),
		);
		echo json_encode($data);
	}

	public function save()
	{
		$this->load->library('form_validation');
		$date_time = date("Y-m-d H:i:s");
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|min_length[5]|max_length[45]|is_unique[gis_user.user_email]|is_unique[gis_register.register_email]',
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
		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|required|min_length[5]|max_length[20]|is_unique[gis_user.user_username]|is_unique[gis_register.register_username]',
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
		$this->form_validation->set_rules(
			'phone',
			'Nomor Telepon',
			'trim|required|min_length[5]|max_length[20]|is_unique[gis_register.register_phone]',
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
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
		if ($this->form_validation->run() == FALSE) {
			$res =  array(
				'is_success' => false,
				'message' => validation_errors()
			);
			echo json_encode($res);
			exit;
		}
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[5]|max_length[20]|matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$res =  array(
				'is_success' => false,
				'message' => validation_errors()
			);
			echo json_encode($res);
			exit;
		}
		$register_username = $this->input->post('username');
		$register_email = $this->input->post('email');
		$register_password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');
		$register_name = $this->input->post('developer_name');
		$kota = $this->input->post('kota');
		$kecamatan_id = $this->input->post('kecamatan');
		$register_address = $this->input->post('address');
		$register_lat = $this->input->post('loc_lat');
		$register_lng = $this->input->post('loc_lng');
		$register_phone = $this->input->post('phone');
		$register_recomended_by = $this->input->post('recomendation');
		$register_accept_agrement = $this->input->post('agreement');
		$uniqid = uniqid('gis_', true);
		$data['data_register'] = array(
			"kecamatan_id" => $kecamatan_id,
			"register_name" => $register_name,
			"register_address" => $register_address,
			"register_phone" => $register_phone,
			"register_email" => $register_email,
			"register_username" => $register_username,
			"register_password" => md5($register_password),
			"register_uniq_code" => $uniqid,
			"register_recomended_by" => $register_recomended_by,
			"register_lat" => $register_lat,
			"register_lng" => $register_lng,
			"register_lng" => $register_lng,
			"register_status" => 1,
			"register_email_verify_status" => 1,
			"register_email_verify_date" => $date_time,
			"register_mandatory_approve" => 1,
			"register_accept_agrement" => $register_accept_agrement ? 1 : 0,
		);
		$f_pasphoto = 'f_pasphoto';
		$f_ktp = 'f_ktp';
		$f_akte = 'f_akte';
		$f_keterangan = 'f_keterangan';
		$f_npwp = 'f_npwp';
		$f_siup = 'f_siup';
		$f_tdp = 'f_tdp';
		$f_susunan_dewan = 'f_susunan_dewan';
		$f_pernyataan = 'f_pernyataan';
		$filePath = "./assets/uploads/register/" . $register_phone;
		$filePathUrl = "assets/uploads/register/" . $register_phone;
		$this->load->helper('upload');
		$uploadParams = array(
			'file_name' => $f_pasphoto,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File Pas Photo",
		);
		$uploadData = uploadSingleFile($f_pasphoto, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;
		$uploadParams = array(
			'file_name' => $f_ktp,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File KTP Direktur",
		);
		$uploadData = uploadSingleFile($f_ktp, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;
		$uploadParams = array(
			'file_name' => $f_akte,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File Akte Pendirian",
		);
		$uploadData = uploadSingleFile($f_akte, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;
		$uploadParams = array(
			'file_name' => $f_keterangan,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File Keterangan Domisili",
		);
		$uploadData = uploadSingleFile($f_keterangan, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;
		$uploadParams = array(
			'file_name' => $f_npwp,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File NPWP",
		);
		$uploadData = uploadSingleFile($f_npwp, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;
		$uploadParams = array(
			'file_name' => $f_siup,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File SIUP",
		);
		$uploadData = uploadSingleFile($f_siup, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;
		$uploadParams = array(
			'file_name' => $f_tdp,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File TDP",
		);
		$uploadData = uploadSingleFile($f_tdp, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;
		$uploadParams = array(
			'file_name' => $f_susunan_dewan,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File Susunan Dewan",
		);
		$uploadData = uploadSingleFile($f_susunan_dewan, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;
		$uploadParams = array(
			'file_name' => $f_pernyataan,
			'file_allowed' => 'pdf|jpeg|png|jpg',
			'file_max_size' => '10000',
			'file_upload_path' => $filePath,
			'file_overwrite' => true,
			'file_type_name' => "File Pernyataan",
		);
		$uploadData = uploadSingleFile($f_pernyataan, $uploadParams);
		if (!is_array($uploadData)) {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}
		$upload[] = $uploadData;

		if (count($upload) > 0) {
			foreach ($upload as $row) {
				foreach ($row as $f) {
					$data['data_atatchment'][] = array(
						'register_attachment_name' => $f['file_name'],
						'register_attachment_dir' => $filePath . '/' . $f['file_name'],
						'register_attachment_url' => site_url($filePathUrl) . '/' . $f['file_name'],
						'register_attachment_type' => $f['file_type_name'],
					);
				}
			}
		} else {
			$res = array(
				'is_success' => false,
				'message' =>  $uploadData
			);
			echo json_encode($res);
			exit;
		}

		$this->db->trans_begin();
		$data['data_register']['register_created_date'] = $date_time;

		$this->register->insertData($data['data_register']);
		$i = 0;
		$register_id = $this->db->insert_id();
		foreach ($data['data_atatchment'] as $da) {
			$mapDataAttachment[] = $da;
			$mapDataAttachment[$i]['register_id'] = $register_id;
			$i++;
		}
		$this->register->insertDataAttachment($mapDataAttachment);
		$cond = array(
			'register_username' => $register_username,
			'register_status' => 1,
		);

		$getData = $this->register->getData($cond);
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
			'developer_join_date' => $date_time,
			'developer_status' => 1,
		);
		$this->register->insertDeveloperDetail($data['data_developer_detail']);
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
				'message' => "Berhasil Menambahkan Anggota Baru.",
			);
		}
		// $this->load->helper('email');
		// $url = base_url('auth/register/verify/' . $uniqid . '/' . $register_username);
		// $message = "Hi $register_name, <br> Terimakasih Telah Melakukan Registrasi.<br><br>Silahkan klik verifikasi untuk mengaktifkan akun anda.<br/>
		// <a href='$url'>Verifikasi</a>";
		// // $message = $this->load->view('template/email', $text, TRUE);
		// sendMail($register_email, 'E-mail verification', $message);
		echo json_encode($res);
	}

	public function save_edit()
	{
		// print_r($_FILES);
		// die;
		$this->load->library('form_validation');
		$date_time = date("Y-m-d H:i:s");
		if ($this->input->post('old_email') != $this->input->post('email')) {
			$this->form_validation->set_rules(
				'email',
				'Email',
				'required|min_length[5]|max_length[45]|is_unique[gis_user.user_email]|is_unique[gis_register.register_email]',
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

		if ($this->input->post('old_username') != $this->input->post('username')) {
			$this->form_validation->set_rules(
				'username',
				'Username',
				'trim|required|min_length[5]|max_length[20]|is_unique[gis_user.user_username]|is_unique[gis_register.register_username]',
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

		if ($this->input->post('old_phone') != $this->input->post('phone')) {
			$this->form_validation->set_rules(
				'phone',
				'Nomor Telepon',
				'trim|required|min_length[5]|max_length[20]|is_unique[gis_register.register_phone]',
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

		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');
			if ($this->form_validation->run() == FALSE) {
				$res =  array(
					'is_success' => false,
					'message' => validation_errors()
				);
				echo json_encode($res);
				exit;
			}
			$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[5]|max_length[20]|matches[password]');
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
		$developer_id = $this->input->post('developer_id');
		$register_username = $this->input->post('username');
		$register_email = $this->input->post('email');
		$register_password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');
		$register_name = $this->input->post('developer_name');
		$kota = $this->input->post('kota');
		$kecamatan_id = $this->input->post('kecamatan');
		$register_address = $this->input->post('address');
		$register_lat = $this->input->post('loc_lat');
		$register_lng = $this->input->post('loc_lng');
		$register_phone = $this->input->post('phone');
		$register_recomended_by = $this->input->post('recomendation');
		$register_accept_agrement = $this->input->post('agreement');
		$uniqid = uniqid('gis_', true);
		$data['data_developer_detail'] = array(
			'kecamatan_id' => $kecamatan_id,
			'developer_name' => $register_name,
			'developer_email' => $register_email,
			'developer_phone' => $register_phone,
			'developer_address' => $register_address,
			'developer_lat' => $register_lat,
			'developer_lng' => $register_lng,
		);
		$data['data_user'] = array(
			'role_id' => 3,
			'user_username' => $register_username,
			'user_email' => $register_email,
		);
		if ($register_password) {
			$data['data_user']['user_password'] = $register_password;
		}
		$f_pasphoto = 'f_pasphoto';
		$f_ktp = 'f_ktp';
		$f_akte = 'f_akte';
		$f_keterangan = 'f_keterangan';
		$f_npwp = 'f_npwp';
		$f_siup = 'f_siup';
		$f_tdp = 'f_tdp';
		$f_susunan_dewan = 'f_susunan_dewan';
		$f_pernyataan = 'f_pernyataan';
		$filePath = "./assets/uploads/register/" . $register_phone;
		$filePathUrl = "assets/uploads/register/" . $register_phone;
		$this->load->helper('upload');
		if (isset($_FILES['f_pasphoto']) && $_FILES['f_pasphoto']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_pasphoto,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File Pas Photo",
			);
			$uploadData = uploadSingleFile($f_pasphoto, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}

		if (isset($_FILES['f_ktp']) && $_FILES['f_ktp']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_ktp,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File KTP Direktur",
			);
			$uploadData = uploadSingleFile($f_ktp, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}

		if (isset($_FILES['f_akte']) && $_FILES['f_akte']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_akte,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File Akte Pendirian",
			);
			$uploadData = uploadSingleFile($f_akte, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}

		if (isset($_FILES['f_keterangan']) && $_FILES['f_keterangan']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_keterangan,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File Keterangan Domisili",
			);
			$uploadData = uploadSingleFile($f_keterangan, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}

		if (isset($_FILES['f_npwp']) && $_FILES['f_npwp']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_npwp,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File NPWP",
			);
			$uploadData = uploadSingleFile($f_npwp, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}

		if (isset($_FILES['f_siup']) && $_FILES['f_siup']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_siup,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File SIUP",
			);
			$uploadData = uploadSingleFile($f_siup, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}

		if (isset($_FILES['f_tdp']) && $_FILES['f_tdp']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_tdp,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File TDP",
			);
			$uploadData = uploadSingleFile($f_tdp, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}

		if (isset($_FILES['f_susunan_dewan']) && $_FILES['f_susunan_dewan']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_susunan_dewan,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File Susunan Dewan",
			);
			$uploadData = uploadSingleFile($f_susunan_dewan, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}

		if (isset($_FILES['f_pernyataan']) && $_FILES['f_pernyataan']['error'] == 0) {
			$uploadParams = array(
				'file_name' => $f_pernyataan,
				'file_allowed' => 'pdf|jpeg|png|jpg',
				'file_max_size' => '10000',
				'file_upload_path' => $filePath,
				'file_overwrite' => true,
				'file_type_name' => "File Pernyataan",
			);
			$uploadData = uploadSingleFile($f_pernyataan, $uploadParams);
			if (!is_array($uploadData)) {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
			$upload[] = $uploadData;
		}
		if (isset($upload)) {
			if (count($upload) > 0) {
				foreach ($upload as $row) {
					foreach ($row as $f) {
						$data['data_atatchment'][] = array(
							'register_attachment_name' => $f['file_name'],
							'register_attachment_dir' => $filePath . '/' . $f['file_name'],
							'register_attachment_url' => site_url($filePathUrl) . '/' . $f['file_name'],
							'register_attachment_type' => $f['file_type_name'],
						);
					}
				}
			} else {
				$res = array(
					'is_success' => false,
					'message' =>  $uploadData
				);
				echo json_encode($res);
				exit;
			}
		}

		$this->db->trans_begin();
		$this->user->updateUser($data['data_user'], array(
			'user_id' => $user_id
		));
		$this->anggota->update($data['data_developer_detail'], array(
			'user_id' => $user_id,
			'developer_id' => $developer_id,
		), 'gis_developer_detail');
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
		// $url = base_url('auth/register/verify/' . $uniqid . '/' . $register_username);
		// $message = "Hi $register_name, <br> Terimakasih Telah Melakukan Registrasi.<br><br>Silahkan klik verifikasi untuk mengaktifkan akun anda.<br/>
		// <a href='$url'>Verifikasi</a>";
		// // $message = $this->load->view('template/email', $text, TRUE);
		// sendMail($register_email, 'E-mail verification', $message);
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
			'pages/anggota/edit.js',
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
			'menu_allow' => $this->data['menu_allow'],
			'user_allow_menu' => $this->data['user_allow_menu'],
		);
		$developer_email = urldecode($developer_email);
		$cond = array(
			"dd.developer_id" => $developer_id,
			"dd.developer_email" => $developer_email,
		);
		$data['data_edit'] = $this->anggota->getOne($cond);
		$data['data_edit_attachment'] = $this->anggota->getOneAttachment($cond);
		$this->template->load('default', 'anggota/edit', $data);
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
		$register_id = $this->input->post('register_id');
		$this->db->trans_begin();
		$this->anggota->deleteData(array(
			"user_id" => $user_id,
		), 'gis_user');
		$this->anggota->deleteData(array(
			"register_id" => $register_id,
		), 'gis_register');
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
		echo json_encode($res);
	}
}
