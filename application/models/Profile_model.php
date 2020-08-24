<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Profile_model extends CI_Model
{
    function getUserDetail($params)
    {
        $this->db->select('u.*, ud.*');
        $this->db->from('gis_user u');
        $this->db->join('gis_user_detail ud', 'ud.user_id=u.user_id', 'left');
        $this->db->where($params['cond']);
        return $this->db->get();
    }

    function update($params)
    {
        $this->db->where($params['cond']);
        return $this->db->update('gis_user', $params['data_user']);
    }

    function updateUser($params)
    {
        $this->db->where($params['cond']);
        return $this->db->update('gis_user', $params['data_user']);
    }

    function insertUserDetail($data)
    {
        return $this->db->insert('gis_user_detail', $data['data_user_detail']);
    }

    function updateUserDetail($params)
    {
        $this->db->where($params['cond']);
        return $this->db->update('gis_user_detail', $params['data_user_detail']);
    }
}
