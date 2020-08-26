<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->plugins_path_css = array();
        $this->plugins_path_js = array();
        $this->css_path = array();
        $this->js_path = array();
        $this->systemSetting = getSystemSetting();
        $this->load->model('gis_model', 'gis');
    }

    function getKecamatan()
    {
        $kota_id = $this->input->post('kota');
        $data['cond'] = array(
            'kota_id' => $kota_id
        );
        $res = $this->gis->get_kecamatan($data);
        echo json_encode($res);
    }
}
