<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Model
		$this->load->model('register_model', 'register');
	}

	function index()
	{
		$this->load->library('form_validation');
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
			"register_status" => 2,
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
		$data['data_register']['register_created_date'] = date("Y-m-d H:i:s");
		$this->register->insertData($data['data_register']);
		$i = 0;
		$register_id = $this->db->insert_id();
		foreach ($data['data_atatchment'] as $da) {
			$mapDataAttachment[] = $da;
			$mapDataAttachment[$i]['register_id'] = $register_id;
			$i++;
		}
		$this->register->insertDataAttachment($mapDataAttachment);
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
				'message' => "Pendaftaran Berhasil Dilakukan, Silahkan Verifikasi E-mail Anda. Dan Tunggu Pemberitahuan Terkait Validasi Pendaftaran.",
			);
		}
		$this->load->helper('email');
		$url = base_url('auth/register/verify/' . urlencode($uniqid) . '/' . urlencode($register_username));
		$message = "Hi $register_name, <br> Terimakasih Telah Melakukan Registrasi.<br><br>Silahkan klik verifikasi untuk mengaktifkan akun anda.<br/>
        <a href='$url'>Verifikasi</a>";
		// $message = $this->load->view('template/email', $text, TRUE);
		sendMail($register_email, 'E-mail verification', $message);
		echo json_encode($res);
	}

	function verify()
	{
		$uniqid = $this->uri->segment(4);
		$username = $this->uri->segment(5);

		$cond = array(
			'register_uniq_code' => urldecode($uniqid),
			'register_username' => urldecode($username),
			'register_status' => 2,
		);

		$getData = $this->register->getData($cond);
		$registerStatus = $getData[0]['register_mandatory_approve'] == 0 ? 1 : 2;
		if ($getData && ($getData[0]['register_email_verify_status'] != 1)) {
			$this->db->trans_begin();
			$this->register->verifyEmail($cond, $registerStatus);
			if ($getData[0]['register_mandatory_approve'] == 1) {
				$message = "Terimakasih telah melakukan verifikasi alamat e-mail anda. Pendaftaran anda sedang menunggu validasi oleh admin, silahkan tunggu info selanjutnya!";
			} else {
				$message = "Terimakasih telah melakukan verifikasi alamat e-mail anda. Akun anda sekarang sudah aktif, silahkan gunakan credential yang digunakan pada saat registrasi untuk login.";
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
			}
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->db->error();
			} else {
				$this->db->trans_commit();

				$data = array(
					'message' =>  $message
				);
				$this->load->view('auth/email_confirmation', $data);
				// $message = $this->load->view('template/mail', $dataTemplate, TRUE);
				$this->load->helper('email');
				sendMail($getData[0]['register_email'], 'E-mail verification', $message);
			}
		} else {
			redirect('auth/login');
		}
	}
}
