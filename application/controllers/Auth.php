<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Pegawai_login_model');
        $this->load->model('Log_user_model');
    }

    public function index()
    {
        show_404();
    }

    public function login()
    {
        $this->load->library('form_validation');

        $rules = $this->Auth_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            redirect(site_url());
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->Auth_model->login($username, $password)) {
            $this->Log_user_model->login_sukses($username);
            redirect('admin/home');
        } elseif ($this->Pegawai_login_model->login_pimpinan($username, $password)) {
            $this->Log_user_model->login_sukses($username);
            redirect('pimpinan/home');
        } elseif ($this->Pegawai_login_model->login_pegawai($username, $password)) {
            $this->Log_user_model->login_sukses($username);
            redirect('bagian/home');
        } else {
            $this->Log_user_model->login_gagal($username);
            $this->session->set_flashdata('pesan_gagal', 'Login Gagal, pastikan username dan passwrod benar!');
        }

        redirect(site_url());
    }

    public function logout()
    {
        if ($this->Auth_model->current_user()) {
            $this->Log_user_model->logout_user($this->Auth_model->current_user()->USERNAME);
            $this->Auth_model->logout();
        } else {
            $this->Log_user_model->logout_user($this->Pegawai_login_model->current_user()->USERNAME);
            $this->Pegawai_login_model->logout();
        }
        redirect(site_url());
    }
}
