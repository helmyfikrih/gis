<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_frontend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->plugins_path_css = array();
        $this->plugins_path_js = array();
        $this->css_path = array();
        $this->js_path = array();
    }

    public function index()
    {
        $this->plugins_path_css = array(
            'select2/css/select2.min.css',
        );
        $this->plugins_path_js = array(
            'select2/js/select2.full.min.js',
        );
        $this->js_path = array(
            'pages/map.js',
        );
        $data = array(
            'header_title' => "Home",
            'css_path' => $this->css_path,
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'js_path' => $this->js_path,
        );
        $this->template->load('frontend', 'frontend/index', $data);
    }
}
