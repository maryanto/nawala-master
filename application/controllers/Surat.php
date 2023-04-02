<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        redirect(site_url());
    }

    public function view($id)
    {
        $this->load->model('Surat_keluar_model');
        $this->load->model('Instansi_model');
        if (!$this->Surat_keluar_model->getRelease($id)) {
            redirect(site_url());
        } else {
            $this->data['surat_keluar'] = $this->Surat_keluar_model->getRelease($id);
            $this->data['instansi'] = $this->Instansi_model->getInstansi();
            $this->data['judul'] = 'Surat Keluar';
            $this->load->view('surat_keluar/v_surat_keluar_info', $this->data);
        }
    }
}
