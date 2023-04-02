<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Instansi_model extends CI_Model
{

    private $_table = "t_instansi";

    public function rules()
    {
        return [
            [
                'field' => 'nm_instansi',
                'label' => 'Nama Instansi',
                'rules' => 'required'
            ]
        ];
    }

    public function getInstansi()
    {
        return $this->db->get($this->_table)->row();
    }

    public function update()
    {
        $post = $this->input->post();
        $this->NM_INSTANSI = $post["nm_instansi"];
        $this->ALAMAT = $post["alamat"];
        $this->NO_TELP = $post["no_telp"];
        $this->WEBSITE = $post["website"];
        $this->EMAIL = $post["email"];
        $this->USER_ID = $post["user_id"];
        $this->db->update($this->_table, $this, array('ID_INSTANSI' => '1'));
    }
}
