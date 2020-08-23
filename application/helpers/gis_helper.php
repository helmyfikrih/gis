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
