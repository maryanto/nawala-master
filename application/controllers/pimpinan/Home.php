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
        $this->load->model('Pegawai_login_model');
        if (!$this->Pegawai_login_model->current_user() or $this->Pegawai_login_model->current_user()->PIMPINAN != 1) {
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
        $this->data['user'] = $this->Pegawai_login_model->current_user();
        $this->data['judul'] = 'Dashboard';
        $this->data['menu'] = 'pimpinan/v_menu';
        $this->data['contents'] = 'pimpinan/v_default';
        $this->load->view('pimpinan/v_home', $this->data);
    }
}
