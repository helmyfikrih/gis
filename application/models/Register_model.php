<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register_model extends CI_Model
{
    function insertData($data)
    {
        return $this->db->insert('gis_register', $data);
    }

    function insertDataAttachment($data)
    {
        return $this->db->insert_batch('gis_register_attachment', $data);
    }
}
