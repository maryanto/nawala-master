<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Tentang Aplikasi';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'v_about';
        $this->load->view('admin/v_home', $this->data);
    }
}
