<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_srt_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_srt_masuk_model');
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['jenis_masuk'] = $this->Jenis_srt_masuk_model->getAll();
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Referensi Jenis Surat Masuk';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'referensi/v_jenis_srt_masuk';
        $this->load->view('admin/v_home', $this->data);
    }

    public function add()
    {
        $Data = $this->Jenis_srt_masuk_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->save();
            $this->session->set_flashdata('sukses', 'Data Jenis Surat Masuk Berhasil disimpan');
        } else {
            $this->session->set_flashdata('gagal', 'Data Jenis Surat Masuk Gagal disimpan');
        }
        redirect(site_url('admin/jenis_srt_masuk'));
    }

    public function edit()
    {
        $Data = $this->Jenis_srt_masuk_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->update();
            $this->session->set_flashdata('sukses', 'Data Jenis Surat Masuk Berhasil di ubah');
        }

        redirect(site_url('admin/jenis_srt_masuk'));
    }

    public function hapus($id = null)
    {
        if (!isset($id)) show_404();
        $cekPakai = $this->Jenis_srt_masuk_model->cekPakai($id);
        if ($cekPakai > 0) {
            $this->session->set_flashdata('gagal', 'Data Jenis Surat Masuk Tidak bisa hapus, karena sudah di gunakan di data Surat Masuk');
            redirect(site_url('admin/jenis_srt_masuk'));
        } else {
            if ($this->Jenis_srt_masuk_model->delete($id)) {
                $this->session->set_flashdata('gagal', 'Data Jenis Surat Masuk Berhasil di hapus');
                redirect(site_url('admin/jenis_srt_masuk'));
            }
        }
    }
}
