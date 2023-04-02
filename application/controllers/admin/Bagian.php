<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bagian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Bagian_model');
        $this->load->library('form_validation');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['bidang'] = $this->Bagian_model->getAll();

        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Data Bidang / Urusan';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'bagian/v_bagian';
        $this->load->view('admin/v_home', $this->data);
    }

    public function add()
    {
        $Data = $this->Bagian_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->save();
            $this->session->set_flashdata('sukses', 'Data Jenis Bagian Berhasil disimpan');
        } else {
            $this->session->set_flashdata('gagal', 'Data Jenis Bagian Gagal disimpan');
        }
        redirect(site_url('admin/bagian'));
    }

    public function edit()
    {
        $Data = $this->Bagian_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->update();
            $this->session->set_flashdata('sukses', 'Data Jenis Bagian Berhasil di ubah');
        }

        redirect(site_url('admin/bagian'));
    }

    public function hapus($id = null)
    {
        if (!isset($id)) show_404();
        $cekPakai = $this->Bagian_model->cekPakai($id);
        if ($cekPakai > 0) {
            $this->session->set_flashdata('gagal', 'Data Jenis Bagian Tidak bisa hapus, karena sudah di gunakan di penempatan data Pegawai');
            redirect(site_url('admin/bagian'));
        } else {
            if ($this->Bagian_model->delete($id)) {
                $this->session->set_flashdata('gagal', 'Data Jenis Bagian Berhasil di hapus');
                redirect(site_url('admin/bagian'));
            }
        }
    }
}
