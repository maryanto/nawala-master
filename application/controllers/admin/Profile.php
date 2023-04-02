<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Update Profil Pengguna';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'profile/v_profile';
        $this->load->view('admin/v_home', $this->data);
    }

    public function update()
    {
        $this->load->library('form_validation');

        $user = $this->Auth_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules_update());

        if ($validation->run()) {
            $user->update();
            $this->session->set_flashdata('sukses', 'Data Pengguna berhasil diperbarui');
        }

        redirect('admin/profile');
    }
}
