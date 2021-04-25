<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('esc')) {
	function esc($str)
	{
		return htmlentities($str, ENT_QUOTES, 'UTF-8');
	}
}

if (!function_exists('isExistUsername')) {
	function isExistUsername($username)
	{
		$ci = &get_instance();
		$ci->load->database();
		$q  = "SELECT * FROM gis_user WHERE 1=1 AND user_username = '${$username}'";
		$res =  $ci->db->query($q)->result_array();
		if (count($res) > 0) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('isExisEmail')) {
	function isExisEmail($email)
	{
		$ci = &get_instance();
		$ci->load->database();
		$q  = "SELECT * FROM gis_user WHERE 1=1 AND user_email = '${$email}'";
		$res =  $ci->db->query($q)->result_array();
		if (count($res) > 0) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('isExistUserDetail')) {
	function isExistUserDetail($user_id)
	{
		$ci = &get_instance();
		$ci->load->database();
		$q  = "SELECT * FROM gis_user_detail WHERE 1=1 AND user_id = $user_id";
		$res =  $ci->db->query($q)->result_array();
		if (count($res) > 0) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('getSystemSetting')) {
	function getSystemSetting()
	{
		$ci = &get_instance();
		$ci->load->database();
		$ci->db->where('system_settings_id', 1);
		$result =  $ci->db->get('gis_system_settings')->result();
		foreach ($result as $system) {
			$systemData = $system;
		}
		return $systemData;
	}
}

if (!function_exists('getSessionData')) {
	function getSessionData()
	{
		$ci = &get_instance();
		$ci->load->database();
		$ci->load->library('session');

		$user_id = $ci->session->userdata('logged_in')['user_id'];
		$username = $ci->session->userdata('logged_in')['username'];
		$data['cond'] = array(
			'u.user_id' => $user_id,
			'u.user_username' => $username,
		);
		$ci->db->select('u.user_username, u.user_email, u.role_id, u.user_status, r.role_name, u.user_id, ud.*');
		$ci->db->from('gis_user u');
		$ci->db->where($data['cond']);
		$ci->db->join('gis_user_role r', 'r.role_id=u.role_id');
		$ci->db->join('gis_user_detail ud', 'u.user_id=ud.user_id', 'left');
		$res = $ci->db->get()->result();
		$data = array();
		foreach ($res as $r) {
			$data = $r;
		}
		return $data;
	}
}

if (!function_exists('getUserGenderString')) {
	function getUserGenderString($string)
	{
		if ($string == "P" or $string == "p") {
			return "perempuan";
		} else  if ($string == "L" or $string == "l") {
			return "laki-laki";
		} else {
			return 'undifined';
		}
	}
}

if (!function_exists('getUserStatusString')) {
	function getUserStatusString($string)
	{
		if ($string == "1" or $string == 1) {
			return "Active";
		} else  if ($string == "0" or $string == 0) {
			return "Inactive";
		} else {
			return 'undifined';
		}
	}
}

if (!function_exists('checkDuplicate')) {
	function checkDuplicate($col, $table, $cond, $join = null)
	{
		$ci = &get_instance();
		$ci->load->database();
		$ci->db->select($col);
		$ci->db->from($table);
		if ($join) {
			foreach ($join as $j) {
			}
		}
		$ci->db->where($cond);
		$res =  $ci->db->get()->result_array();
		if (count($res) > 0) {
			return true;
		} else {
			return false;
		}
	}
}
