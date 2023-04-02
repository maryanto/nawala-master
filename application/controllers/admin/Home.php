<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Surat_masuk_model');
        $this->load->model('Surat_keluar_model');
        $this->load->model('Disposisi_model');
        $this->load->model('Auth_model');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['jmlSuratMasuk'] = $this->Surat_masuk_model->getJumlah();
        $this->data['jmlSuratKeluar'] = $this->Surat_keluar_model->getJumlah();
        $this->data['jmlDisposisi'] = $this->Disposisi_model->getJumlah();
        $this->data['surat_masuk'] = $this->Surat_masuk_model->getTerbaru();
        $this->data['surat_keluar'] = $this->Surat_keluar_model->getTerbaru();

        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Dashboard';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'admin/v_default';
        $this->load->view('admin/v_home', $this->data);
    }
}
