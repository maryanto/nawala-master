<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_login_model');
        $this->load->model('Auth_model');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->load->model('Pegawai_model');

        $this->data['pegawai'] = $this->Pegawai_model->getAll();
        $this->data['pimpinan'] = $this->Pegawai_login_model->getPimpinan();
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Data Pimpinan';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'pimpinan/v_pimpinan';
        $this->load->view('admin/v_home', $this->data);
    }

    public function add()
    {
        $this->load->library('form_validation');

        $Data = $this->Pegawai_login_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        $cekAkun = $this->Pegawai_login_model->cekStatusLogin($this->input->post('id_pegawai'));
        $cekUsername = $this->Pegawai_login_model->cekUsername($this->input->post('username'));


        if ($validation->run() && $cekAkun < 1 && $cekUsername < 1) {
            $Data->save();
            $this->session->set_flashdata('sukses', 'Data Akun Pimpinan Berhasil disimpan');
        } else {
            $this->session->set_flashdata('gagal', 'Data Akun Pimpinan Masuk Gagal disimpan, karena Data Pegawai tersebut sudah ada di Data Login');
        }
        redirect(site_url('admin/pimpinan'));
    }

    public function edit()
    {
        $this->load->library('form_validation');

        $Data = $this->Pegawai_login_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());
        $cekUsername = $this->Pegawai_login_model->cekUsername($this->input->post('username'));

        if ($validation->run() && $cekUsername < 1) {
            $Data->update();
            $this->session->set_flashdata('sukses', 'Data Akun Pimpinan Berhasil di ubah');
        } else {
            $this->session->set_flashdata('gagal', 'Data Akun Pimpinan  Gagal di ubah, karena Data Pegawai tersebut sudah ada di Data Login');
        }

        redirect(site_url('admin/pimpinan'));
    }

    public function hapus($id = null)
    {
        if (!isset($id)) show_404();
        $user = $this->Pegawai_login_model->getById($id);
        $cekPakai = $this->Pegawai_login_model->cekPakai($user->ID_PEGAWAI);
        if ($cekPakai > 0) {
            $this->session->set_flashdata('gagal', 'Data Akun Pimpinan Tidak bisa hapus, karena sudah di gunakan di data surat masuk');
            redirect(site_url('admin/pimpinan'));
        } else {
            if ($this->Pegawai_login_model->delete($id)) {
                $this->session->set_flashdata('gagal', 'Data Akun Pimpinan Berhasil di hapus');
                redirect(site_url('admin/pimpinan'));
            }
        }
    }
}
