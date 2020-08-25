<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Settings_model extends CI_Model
{

    function updateSetting($data)
    {
        $this->db->where('system_settings_id', 1);
        return $this->db->update('gis_system_settings', $data);
    }
}
