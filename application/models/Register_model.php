<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register_model extends CI_Model
{
    function getData($cond)
    {
        $this->db->where($cond);
        return $this->db->get('gis_register')->result_array();
    }

    function insertData($data)
    {
        return $this->db->insert('gis_register', $data);
    }

    function insertDataAttachment($data)
    {
        return $this->db->insert_batch('gis_register_attachment', $data);
    }

    function verifyEmail($cond)
    {
        $registerStatus = 2;
        $data = array(
            'register_email_verify_status' => 1,
            'register_email_verify_date' => date("Y-m-d H:i:s"),
            'register_status' => $registerStatus
        );
        $this->db->where($cond);
        return $this->db->update('gis_register', $data);
    }
}
