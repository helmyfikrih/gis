<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Gis_model extends CI_Model
{
    function get_kecamatan($params)
    {
        $this->db->where($params['cond']);
        return $this->db->get('gis_kecamatan')->result();
    }
}
