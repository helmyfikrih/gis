<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('getSelectRole')) {
    function getSelectRole()
    {
        $ci = &get_instance();
        $ci->load->database();
        $q  = "SELECT * FROM gis_user_role WHERE 1=1 AND role_status = 1";
        return $ci->db->query($q)->result();
    }
}

if (!function_exists('getSelectKota')) {
    function getSelectKota()
    {
        $ci = &get_instance();
        $ci->load->database();
        $q  = "SELECT * FROM gis_kota WHERE 1=1";
        return $ci->db->query($q)->result();
    }
}
