<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->plugins_path_css = array();
		$this->plugins_path_js = array();
		$this->css_path = array();
		$this->js_path = array();
	}

	public function index()
	{
		$this->plugins_path_css = array(
			'select2/css/select2.min.css',
		);
		$this->plugins_path_js = array(
			'select2/js/select2.full.min.js',
		);
		$this->js_path = array(
			'pages/map.js',
		);
		$data = array(
			'header_title' => "Home",
			'css_path' => $this->css_path,
			'plugins_path_css' => $this->plugins_path_css,
			'plugins_path_js' => $this->plugins_path_js,
			'js_path' => $this->js_path,
			'select_kota' => getSelectKota(),
		);
		$this->template->load('frontend', 'frontend/map', $data);
	}

	public function filter()
	{
		$this->load->model('Gis_model', 'gis');
		$f_search = trim($this->input->post('f_search'));
		$f_kota = $this->input->post('f_kota');
		$f_kecamatan = $this->input->post('f_kecamatan');
		$cond = array();
		if ($f_search) {
			$cond["dd.developer_name LIKE '%$f_search%' OR dd.developer_address LIKE '%$f_search%'"] = null;
		}
		if ($f_kota && ($f_kota != '0' || $f_kota != '0')) {
			$cond['k.kota_id'] = $f_kota;
		}
		if ($f_kecamatan && ($f_kecamatan != '0' || $f_kecamatan != '0')) {
			$cond['k.kecamatan_id'] = $f_kecamatan;
		}

		$data = $this->gis->get_persebaran($cond);
		echo json_encode(
			array(
				'data' => $data
			)
		);
	}
}
