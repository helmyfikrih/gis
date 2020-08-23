<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
		$data = array(
			'css_path' => $this->css_path,
			'plugins_path_css' => $this->plugins_path_css,
			'plugins_path_js' => $this->plugins_path_js,
			'js_path' => $this->js_path,
			'menu_body' => $this->menu_body,
		);
		$this->template->load('default', 'home/index', $data);
	}
}
