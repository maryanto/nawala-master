<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_srt_masuk_model extends CI_Model
{

    private $_table = "r_jenis_srt_masuk";

    public function rules()
    {
        return [
            [
                'field' => 'nm_jenis_srt_masuk',
                'label' => 'Nama Jenis Surat Masuk',
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
        return $this->db->get_where($this->_table, array('ID_JENIS_SRT_MASUK' => $id))->row();
    }

    public function cekPakai($id)
    {
        return $this->db->get_where('t_surat_masuk', array('ID_JENIS_SRT_MASUK' => $id))->num_rows();
    }


    public function save()
    {
        $post = $this->input->post();
        $this->NM_JENIS_SRT_MASUK = $post["nm_jenis_srt_masuk"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_JENIS_SRT_MASUK = $post["id_jenis_srt_masuk"];
        $this->NM_JENIS_SRT_MASUK = $post["nm_jenis_srt_masuk"];
        $this->db->update($this->_table, $this, array('ID_JENIS_SRT_MASUK' => $post["id_jenis_srt_masuk"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array('ID_JENIS_SRT_MASUK' => $id));
    }
}
