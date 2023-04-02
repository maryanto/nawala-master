<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

    private $_table = "t_pegawai";

    public function rules()
    {
        return [
            [
                'field' => 'nm_pegawai',
                'label' => 'Nama Pegawai',
                'rules' => 'required'
            ],

            [
                'field' => 'alamat',
                'label' => 'Alamat Pegawai',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, array('ID_PEGAWAI' => $id))->row();
    }

    public function cekPakai($id)
    {
        return $this->db->get_where('t_pegawai_login', array('ID_PEGAWAI' => $id))->num_rows();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->ID_PEGAWAI = uniqid();
        $this->NM_PEGAWAI = $post["nm_pegawai"];
        $this->ALAMAT = $post["alamat"];
        $this->EMAIL = $post["email"];
        $this->NO_HANDPHONE = $post["no_handphone"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_PEGAWAI =  $post["id_pegawai"];
        $this->NM_PEGAWAI = $post["nm_pegawai"];
        $this->ALAMAT = $post["alamat"];
        $this->EMAIL = $post["email"];
        $this->NO_HANDPHONE = $post["no_handphone"];
        $this->db->update($this->_table, $this, array('ID_PEGAWAI' => $post["id_pegawai"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array('ID_PEGAWAI' => $id));
    }
}
