<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_srt_keluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_srt_keluar_model');
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['jenis_keluar'] = $this->Jenis_srt_keluar_model->getAll();
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Referensi Jenis Surat Keluar';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'referensi/v_jenis_srt_keluar';
        $this->load->view('admin/v_home', $this->data);
    }

    public function add()
    {
        $Data = $this->Jenis_srt_keluar_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->save();
            $this->session->set_flashdata('sukses', 'Data Jenis Surat Keluar Berhasil disimpan');
        } else {
            $this->session->set_flashdata('gagal', 'Data Jenis Surat Keluar Gagal disimpan');
        }
        redirect(site_url('admin/jenis_srt_keluar'));
    }

    public function edit()
    {
        $Data = $this->Jenis_srt_keluar_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->update();
            $this->session->set_flashdata('sukses', 'Data Jenis Surat Keluar Berhasil di ubah');
        }

        redirect(site_url('admin/jenis_srt_keluar'));
    }

    public function hapus($id = null)
    {
        if (!isset($id)) show_404();
        $cekPakai = $this->Jenis_srt_keluar_model->cekPakai($id);
        if ($cekPakai > 0) {
            $this->session->set_flashdata('gagal', 'Data Jenis Surat Keluar Tidak bisa hapus, karena sudah di gunakan di data Surat Masuk');
            redirect(site_url('admin/jenis_srt_keluar'));
        } else {
            if ($this->Jenis_srt_keluar_model->delete($id)) {
                $this->session->set_flashdata('gagal', 'Data Jenis Surat Keluar Berhasil di hapus');
                redirect(site_url('admin/jenis_srt_keluar'));
            }
        }
    }
}
