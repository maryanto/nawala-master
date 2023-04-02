<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Log_surat_keluar_model extends CI_Model
{
    private $_table = "t_log_surat_keluar";
    private $_view = "v_log_surat_keluar";

    function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'IP tidak dikenali';
        return $ipaddress;
    }

    public function getAll()
    {
        $this->db->order_by('ID_LOG', 'DESC');
        return $this->db->get($this->_view)->result();
    }

    public function getByIdSurat($id)
    {
        $this->db->order_by('WAKTU', 'DESC');
        return $this->db->get_where($this->_table, array('ID_SURAT_KELUAR' => $id))->result();
    }

    public function add_log($username, $id_surat_keluar, $pesan)
    {
        $this->USERNAME = $username;
        $this->IP_ADDRESS = $this->get_client_ip();
        $this->ID_SURAT_KELUAR = $id_surat_keluar;
        $this->CATATAN = $pesan;
        $this->db->insert($this->_table, $this);
    }
}
