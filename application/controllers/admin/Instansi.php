<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Instansi_model');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['instansi'] = $this->Instansi_model->getInstansi();
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Update Profil Instansi';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'instansi/v_instansi';
        $this->load->view('admin/v_home', $this->data);
    }

    public function edit()
    {
        $this->load->library('form_validation');

        $Data = $this->Instansi_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->update();
            $this->session->set_flashdata('sukses', 'Data Profil Instansi Berhasil di ubah');
        } else {
            $this->session->set_flashdata('gagal', 'Data Profil Instansi  Gagal di ubah');
        }

        redirect(site_url('admin/instansi'));
    }
}
