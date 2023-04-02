<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bagian_model extends CI_Model
{

    private $_table = "r_bagian";

    public function rules()
    {
        return [
            [
                'field' => 'nm_bagian',
                'label' => 'Nama Bagian',
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
        return $this->db->get_where($this->_table, array('ID_BAGIAN' => $id))->row();
    }

    public function cekPakai($id)
    {
        return $this->db->get_where('t_pegawai_login', array('ID_BAGIAN' => $id))->num_rows();
    }


    public function save()
    {
        $post = $this->input->post();
        $this->NM_BAGIAN = $post["nm_bagian"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_BAGIAN = $post["id_bagian"];
        $this->NM_BAGIAN = $post["nm_bagian"];
        $this->db->update($this->_table, $this, array('ID_BAGIAN' => $post["id_bagian"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array('ID_BAGIAN' => $id));
    }
}
