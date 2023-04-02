<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_login_model');
        if (!$this->Pegawai_login_model->current_user() or $this->Pegawai_login_model->current_user()->PIMPINAN != 1) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['user'] = $this->Pegawai_login_model->current_user();
        $this->data['judul'] = 'Tentang Aplikasi';
        $this->data['menu'] = 'pimpinan/v_menu';
        $this->data['contents'] = 'v_about';
        $this->load->view('pimpinan/v_home', $this->data);
    }
}
