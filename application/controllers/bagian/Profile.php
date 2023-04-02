<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_login_model');
        if (!$this->Pegawai_login_model->current_user() or $this->Pegawai_login_model->current_user()->PIMPINAN != 0) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['user'] = $this->Pegawai_login_model->current_user();
        $this->data['judul'] = 'Update Profil Pengguna';
        $this->data['menu'] = 'bagian/v_menu';
        $this->data['contents'] = 'profile/v_profile_bagian';
        $this->load->view('bagian/v_home', $this->data);
    }

    public function update()
    {
        $this->load->library('form_validation');

        $user = $this->Pegawai_login_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules_update());

        if ($validation->run()) {
            $user->update();
            $this->session->set_flashdata('sukses', 'Data Pengguna berhasil diperbarui');
        }

        redirect('bagian/profile');
    }
}
