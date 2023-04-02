<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grafik extends CI_Controller
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
        redirect('admin/grafik/masuk');
    }

    public function masuk()
    {
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Grafik Surat masuk';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'grafik/v_graph_srt_masuk';
        $this->load->view('admin/v_home', $this->data);
    }

    public function disposisi()
    {
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Grafik Disposisi Surat Masuk';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'grafik/v_graph_srt_disposisi';
        $this->load->view('admin/v_home', $this->data);
    }

    public function keluar()
    {
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Grafik Surat Keluar';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'grafik/v_graph_srt_keluar';
        $this->load->view('admin/v_home', $this->data);
    }
}
