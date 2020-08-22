<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $pesan = '';
        $w = $this->input->get('w');
        if ($w == 1) {
            $pesan = "Invalid Username OR Password";
        } else {
            $pesan = "Wrong Type Code";
        }
        $this->load->view('auth/login');
    }
}
