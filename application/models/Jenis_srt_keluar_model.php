<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_srt_keluar_model extends CI_Model
{

    private $_table = "r_jenis_srt_keluar";

    public function rules()
    {
        return [
            [
                'field' => 'nm_jenis_srt_keluar',
                'label' => 'Nama Jenis Surat Keluar',
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
        return $this->db->get_where($this->_table, array('ID_JENIS_SRT_KELUAR' => $id))->row();
    }

    public function cekPakai($id)
    {
        return $this->db->get_where('t_surat_keluar', array('ID_JENIS_SRT_KELUAR' => $id))->num_rows();
    }


    public function save()
    {
        $post = $this->input->post();
        $this->NM_JENIS_SRT_KELUAR = $post["nm_jenis_srt_keluar"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_JENIS_SRT_KELUAR = $post["id_jenis_srt_keluar"];
        $this->NM_JENIS_SRT_KELUAR = $post["nm_jenis_srt_keluar"];
        $this->db->update($this->_table, $this, array('ID_JENIS_SRT_KELUAR' => $post["id_jenis_srt_keluar"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array('ID_JENIS_SRT_KELUAR' => $id));
    }
}
