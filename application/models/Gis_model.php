<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Gis_model extends CI_Model
{
	function get_kecamatan($params)
	{
		$this->db->where($params['cond']);
		return $this->db->get('gis_kecamatan')->result();
	}
	function get_persebaran($cond)
	{
		$this->db->select("dd.*");
		$this->db->from("gis_developer_detail dd");
		$this->db->join("gis_kecamatan k", 'k.kecamatan_id=dd.kecamatan_id', 'left');
		if ($cond) {
			$this->db->where($cond);
		}
		return $this->db->get()->result_array();
	}
}
