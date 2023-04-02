<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Disposisi_model');
        $this->load->model('Pegawai_login_model');
        if (!$this->Pegawai_login_model->current_user() or $this->Pegawai_login_model->current_user()->PIMPINAN != 0) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['disposisi'] = $this->Disposisi_model->getTerbaruBagian($this->Pegawai_login_model->current_user()->ID_PEGAWAI);
        $this->data['user'] = $this->Pegawai_login_model->current_user();
        $this->data['judul'] = 'Dashboard';
        $this->data['menu'] = 'bagian/v_menu';
        $this->data['contents'] = 'bagian/v_default';
        $this->load->view('bagian/v_home', $this->data);
    }
}
