<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Log_user_model extends CI_Model
{
    private $_table = "t_log_user";

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
        return $this->db->get($this->_table)->result();
    }

    public function login_sukses($username)
    {
        $this->USERNAME = $username;
        $this->IP_ADDRESS = $this->get_client_ip();
        $this->STATUS = "Login sukses";
        $this->db->insert($this->_table, $this);
    }

    public function login_gagal($username)
    {
        $this->USERNAME = $username;
        $this->IP_ADDRESS = $this->get_client_ip();
        $this->STATUS = "Login gagal";
        $this->db->insert($this->_table, $this);
    }

    public function logout_user($username)
    {
        $this->USERNAME = $username;
        $this->IP_ADDRESS = $this->get_client_ip();
        $this->STATUS = "Berhasil logout";
        $this->db->insert($this->_table, $this);
    }
}
