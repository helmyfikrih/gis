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
        $this->session_data = $this->session->userdata('logged_in');
        $this->menu_body = $this->menu->getmenu($this->session_data['user_id'], $this->session_data['username']);
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->sessionData = getSessionData();
        $this->systemSetting = getSystemSetting();
        // Model
        $this->load->model('news_model', 'news');
        // Menu Access Role
        $urlname    = strtolower($this->router->fetch_class());
        $menu_id       = $this->menu->idMenu($urlname);
        $user_allow = $this->menu->UserAllow($this->session_data['role_id']);
        $user_allow_menu = explode(",", $user_allow[0]['role_allow_menu']);
        $this->data['menu_allow'] = '';
        $this->data['user_allow_menu'] = $user_allow_menu;
        if (@in_array($menu_id[0]['menu_id'], $user_allow_menu)) {
            $this->data['menu_allow'] = 'level_' . $menu_id[0]['menu_id'];
        } else {
            redirect('home');
        }
    }

    public function index()
    {
        $this->plugins_path_css = array(
            'datatables-bs4/css/dataTables.bootstrap4.min.css',
            'datatables-responsive/css/responsive.bootstrap4.min.css',
            'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        );
        $this->plugins_path_js = array(
            'datatables/jquery.dataTables.min.js',
            'datatables-bs4/js/dataTables.bootstrap4.min.js',
            'datatables-responsive/js/dataTables.responsive.min.js',
            'datatables-responsive/js/responsive.bootstrap4.min.js',
            'sweetalert2/sweetalert2.min.js',
        );
        $this->js_path = array(
            'pages/news.js',
        );
        $data = array(
            'user_session' => $this->sessionData,
            'setting' => $this->systemSetting,
            'header_title' => "User Roles",
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'css_path' => $this->css_path,
            'js_path' => $this->js_path,
            'menu_body' => $this->menu_body,
            'menu_allow' => $this->data['menu_allow'],
            'user_allow_menu' => $this->data['user_allow_menu'],
        );
        if ((!in_array($this->data['menu_allow'] . '_read', $this->data['user_allow_menu']))) {
            $this->template->load('default', 'template/403', $data);
        } else {
            $this->template->load('default', 'news/index', $data);
        }
    }

    function getList()
    {
        $cond = array(
            'user_status !=' => null
        );
        $list = $this->news->getList($cond);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            // $no++;
            $row = array();
            $btnEdit = "";
            $btnDelete = "";
            $btnView = "";

            if (array_intersect(array($this->data['menu_allow'] . '_update'), $this->data['user_allow_menu'])) {
                $btnEdit = '<span><a class="btn btn-outline-info btn-sm" href="' . base_url('news/edit/' . $field->news_id . '/' . $field->news_slug) . '"><i class="fa fa-edit"></i> Edit</a></span>';
            }
            if (array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
                $btnDelete = '<span><button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteData(\'' . ($field->news_id) . '\', \'' . ($field->news_slug) . '\')"><i class="fa fa-trash"></i> Delete</button></span>';
            }
            $btnView = '<span><a class="btn btn-outline-success btn-sm" href="' . base_url('news/view/' . $field->news_id . '/' . $field->news_slug) . '"><i class="fa fa-eye"></i> View</a></span>';
            $btn = " <div class='d-none d-sm-block d-sm-none d-md-block'>$btnEdit $btnView $btnDelete</div>";
            $btn .= "   <div class='input-group-prepend d-md-none d-lg-none d-xl-none '>
                          <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                          </button>
                          <div class='dropdown-menu'>
                            <div class='dropdown-item' href='javasctipy:;'>$btnEdit $btnView $btnDelete</div>
                          </div>
                        </div>";
            $status = "";
            if ($field->news_status == 1) {
                $status = '<span class=" badge bg-success">Published</span>';
            } else if ($field->news_status == 0) {
                $status = '<span class=" badge bg-danger">Deleted</span>';
            } else if ($field->news_status == 2) {
                $status = '<span class=" badge bg-info">Draft</span>';
            }
            $row[] = $btn;
            $row[] = $field->news_title;
            $row[] = $field->news_tags;
            $row[] = $field->ud_full_name;
            $row[] = $field->news_created_date;
            $row[] = $status;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->news->count_new($cond),
            "recordsFiltered" => $this->news->count_filtered_new($cond),
            "data"            => $data,
        );
        //output dalam format JSON

        echo json_encode($output);
    }

    function create()
    {
        $this->plugins_path_css = array(
            'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'tags/tagsinput.css',
        );
        $this->plugins_path_js = array(
            'datatables/jquery.dataTables.min.js',
            'sweetalert2/sweetalert2.min.js',
            'jquery-validation/jquery.validate.min.js',
            'jquery-validation/additional-methods.min.js',
            'tags/tagsinput.js',
            'ckfinder/ckfinder.js',
            'ckeditor/ckeditor.js',
        );
        $this->js_path = array(
            'pages/news.js',
        );
        $data = array(
            'user_session' => $this->sessionData,
            'setting' => $this->systemSetting,
            'header_title' => "User Roles",
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'css_path' => $this->css_path,
            'js_path' => $this->js_path,
            'menu_body' => $this->menu_body,
            'menu_allow' => $this->data['menu_allow'],
            'user_allow_menu' => $this->data['user_allow_menu'],
        );
        if ((!in_array($this->data['menu_allow'] . '_create', $this->data['user_allow_menu']))) {
            $this->template->load('default', 'template/403', $data);
        } else {
            $this->template->load('default', 'news/create', $data);
        }
    }

    function edit()
    {

        $this->plugins_path_css = array(
            'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            'tags/tagsinput.css',
        );
        $this->plugins_path_js = array(
            'datatables/jquery.dataTables.min.js',
            'sweetalert2/sweetalert2.min.js',
            'jquery-validation/jquery.validate.min.js',
            'jquery-validation/additional-methods.min.js',
            'tags/tagsinput.js',
            'ckfinder/ckfinder.js',
            'ckeditor/ckeditor.js',
        );
        $this->js_path = array(
            'pages/news.js',
        );
        $news_id = $this->uri->segment(3);
        $news_slug = $this->uri->segment(4);
        $cond = array(
            'news_id' => $news_id,
            'news_slug' => $news_slug,
        );
        $news = $this->news->getOne($cond);
        $data = array(
            'user_session' => $this->sessionData,
            'setting' => $this->systemSetting,
            'header_title' => "User Roles",
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'css_path' => $this->css_path,
            'js_path' => $this->js_path,
            'menu_body' => $this->menu_body,
            'menu_allow' => $this->data['menu_allow'],
            'user_allow_menu' => $this->data['user_allow_menu'],
            'data_news' => $news,
        );
        if ((!in_array($this->data['menu_allow'] . '_update', $this->data['user_allow_menu']))) {
            $this->template->load('default', 'template/403', $data);
        } else {
            $this->template->load('default', 'news/edit', $data);
        }
    }

    function save()
    {

        $news_id = $this->input->post('news_id');
        $news_title = $this->input->post('news_title');
        $news_tags = $this->input->post('news_tags');
        $news_body = $this->input->post('news_body');
        $data['data_news'] = array(
            'user_id' => $this->sessionData->user_id,
            'news_title' => $news_title,
            'news_slug' => url_title($news_title, 'dash', true),
            'news_tags' => $news_tags,
            'news_body' => $news_body,
        );
        $this->db->trans_begin();
        if (!$news_id) {
            if (!array_intersect(array($this->data['menu_allow'] . '_create'), $this->data['user_allow_menu'])) {
                $res = array(
                    'is_success' => false,
                    'message' => "User Tidak Memiliki Hak Akses",
                );
                echo json_encode($res);
                exit;
            } else {

                $data['data_news']['news_status'] = 1;
                $data['data_news']['news_created_date'] = date('Y-m-d H:i:s');
                $data['data_news']['news_created_by'] =  $this->sessionData->user_id;
                $this->news->insert($data);
                $msg = "Berhasil Membuat News";
            }
        } else {
            $data['data_news']['news_last_update'] = date('Y-m-d H:i:s');
            $data['data_news']['news_last_update_by'] =  $this->sessionData->user_id;
            $data['cond'] = array(
                'news_id' => $news_id
            );
            $this->news->update($data);
            $msg = "Berhasil Mengubah News";
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $err = $this->db->error();
            $msg = $err["code"] . "-" . $err["message"];
            $res = array(
                'is_success' => false,
                'message' =>  $msg
            );
        } else {
            $this->db->trans_commit();
            $res = array(
                'is_success' => true,
                'message' => $msg,
            );
        }
        echo json_encode($res);
    }

    function delete()
    {
        if (!array_intersect(array($this->data['menu_allow'] . '_delete'), $this->data['user_allow_menu'])) {
            $res = array(
                'is_success' => false,
                'message' => "User Tidak Memiliki Hak Akses",
            );
            echo json_encode($res);
            exit;
        }

        $news_id = $this->input->post('nid');
        $news_slug = $this->input->post('nslug');

        $data['cond'] = array(
            "news_id" => $news_id,
            "news_slug" => $news_slug,
        );

        if ($this->news->deleteData($data)) {
            $res = array(
                'is_success' => true,
                'message' => "Berhasil Menghapus News",
            );
        } else {
            $err = $this->db->error();
            $res = array(
                'is_success' => false,
                'message' =>  $err
            );
        }
        echo json_encode($res);
    }

    function view()
    {
        $news_id = $this->uri->segment(3);
        $news_slug = $this->uri->segment(4);
        $cond = array(
            'news_id' => $news_id,
            'news_slug' => $news_slug,
        );
        $news = $this->news->getOne($cond);
        $recent_news = $this->news->getRecentNews();
        $data = array(
            'header_title' => "Home",
            'css_path' => $this->css_path,
            'plugins_path_css' => $this->plugins_path_css,
            'plugins_path_js' => $this->plugins_path_js,
            'js_path' => $this->js_path,
            'news' => $news,
            'recent_news' => $recent_news,
        );
        if ($news) {
            $this->template->load('frontend', 'news/view', $data);
        } else {
            $this->template->load('frontend', 'frontend/404', $data);
        }
    }
}
