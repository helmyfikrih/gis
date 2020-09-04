<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->plugins_path_css = array();
        $this->plugins_path_js = array();
        $this->css_path = array();
        $this->js_path = array();

        $this->load->library('pagination');

        // model
        $this->load->model('news_model', 'news');
    }

    public function index()
    {

        $this->js_path = array(
            'pages/news.js',
        );
        $data = array(
            'header_title' => "Home",
            'css_path' => $this->css_path,
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'js_path' => $this->js_path,
        );
        $this->template->load('frontend', 'frontend/news', $data);
    }

    public function loadRecord($rowno = 0)
    {

        // Row per page
        $rowperpage = 5;

        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        // All records count
        $allcount = $this->news->getDataListCount();

        // Get records
        $users_record = $this->news->getDataList($rowno, $rowperpage);

        // Pagination Configuration
        $config['base_url'] = base_url() . '/forum/loadRecord';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        $config['full_tag_open']    = '<div class="center"><ul class="pagination">';
        $config['full_tag_close']   = '</ul></div>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"';
        $config['cur_tag_close']    = '</li>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']  = '</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']  = '</li>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']  = '</li>';

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;

        echo json_encode($data);
    }
}
