<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


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
        $ci->db->select('u.user_username, u.user_email, u.role_id,r.role_name, u.user_id, ud.*');
        $ci->db->from('gis_user u');
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
