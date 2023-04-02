<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_login_model extends CI_Model
{

    private $_table = "t_pegawai_login";
    const SESSION_KEY = 'ID_LOGIN';

    public function rules()
    {
        return [

            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|max_length[255]'
            ]
        ];
    }

    public function rules_update()
    {
        return [

            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ]
        ];
    }

    // login pengguna pegawai
    public function login_pimpinan($username, $password)
    {
        $this->db->where('USERNAME', $username);
        $this->db->where('PIMPINAN', '1');
        $query = $this->db->get($this->_table);
        $user = $query->row();

        if (!$user) {
            return FALSE;
        }

        if (!password_verify($password, $user->PASSWORD)) {
            return FALSE;
        }

        $this->session->set_userdata([self::SESSION_KEY => $user->ID_LOGIN]);
        $this->_update_last_login($user->ID_LOGIN);

        return $this->session->has_userdata(self::SESSION_KEY);
    }

    public function login_pegawai($username, $password)
    {
        $this->db->where('USERNAME', $username);
        $this->db->where('PIMPINAN', '0');
        $query = $this->db->get($this->_table);
        $user = $query->row();

        if (!$user) {
            return FALSE;
        }

        if (!password_verify($password, $user->PASSWORD)) {
            return FALSE;
        }

        $this->session->set_userdata([self::SESSION_KEY => $user->ID_LOGIN]);
        $this->_update_last_login($user->ID_LOGIN);

        return $this->session->has_userdata(self::SESSION_KEY);
    }

    public function current_user()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }

        $user_id = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table, ['ID_LOGIN' => $user_id]);
        return $query->row();
    }

    private function _update_last_login($id)
    {
        $data = [
            'LAST_LOGIN' => date("Y-m-d H:i:s"),
        ];

        return $this->db->update($this->_table, $data, ['ID_LOGIN' => $id]);
    }

    public function logout()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->session->has_userdata(self::SESSION_KEY);
    }
    // login pengguna pegawai

    public function getPimpinan()
    {
        $this->db->select('t_pegawai_login.ID_LOGIN');
        $this->db->select('t_pegawai_login.ID_PEGAWAI');
        $this->db->select('t_pegawai.NM_PEGAWAI');
        $this->db->select('t_pegawai_login.USERNAME');
        $this->db->select('t_pegawai_login.PASSWORD');
        $this->db->select('t_pegawai_login.AKTIF');
        $this->db->select('t_pegawai_login.LAST_LOGIN');
        $this->db->join('t_pegawai', 't_pegawai.ID_PEGAWAI = t_pegawai_login.ID_PEGAWAI', 'LEFT');
        $this->db->group_by('t_pegawai_login.ID_PEGAWAI');
        return $this->db->get_where($this->_table, array('t_pegawai_login.PIMPINAN' => '1'))->result();
    }

    public function getPegawai()
    {
        $this->db->select('t_pegawai_login.ID_LOGIN');
        $this->db->select('t_pegawai_login.ID_PEGAWAI');
        $this->db->select('t_pegawai_login.ID_BAGIAN');
        $this->db->select('t_pegawai.NM_PEGAWAI');
        $this->db->select('t_pegawai_login.USERNAME');
        $this->db->select('t_pegawai_login.PASSWORD');
        $this->db->select('t_pegawai_login.AKTIF');
        $this->db->select('t_pegawai_login.LAST_LOGIN');
        $this->db->join('t_pegawai', 't_pegawai.ID_PEGAWAI = t_pegawai_login.ID_PEGAWAI', 'LEFT');
        $this->db->group_by('t_pegawai_login.ID_PEGAWAI');
        return $this->db->get_where($this->_table, array('t_pegawai_login.PIMPINAN' => '0'))->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, array('ID_LOGIN' => $id))->row();
    }

    public function cekPakai($id)
    {
        return $this->db->get_where('t_surat_masuk', array('ID_TUJUAN' => $id))->num_rows();
    }

    public function cekPakaiPegawai($id)
    {
        return $this->db->get_where('t_disposisi', array('ID_PENERIMA' => $id))->num_rows();
    }

    public function cekStatusLogin($id)
    {
        return $this->db->get_where('t_pegawai_login', array('ID_PEGAWAI' => $id))->num_rows();
    }

    public function cekUsername($id)
    {
        return $this->db->get_where('t_pegawai_login', array('USERNAME' => $id))->num_rows();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->ID_LOGIN = uniqid();
        $this->ID_PEGAWAI = $post["id_pegawai"];
        $this->USERNAME = $post["username"];
        $this->PASSWORD = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->ID_BAGIAN = $post["id_bagian"];
        $this->AKTIF = '1';
        $this->PIMPINAN = $post["pimpinan"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_LOGIN = $post["id_login"];
        $this->ID_PEGAWAI = $post["id_pegawai"];
        $this->USERNAME = $post["username"];
        if ($post["password"] == '') {
            $this->PASSWORD = $post["old_password"];
        } else {
            $this->PASSWORD = password_hash($post["password"], PASSWORD_DEFAULT);
        }
        $this->ID_BAGIAN = $post["id_bagian"];
        $this->AKTIF = $post["aktif"];
        $this->PIMPINAN = $post["pimpinan"];
        $this->db->update($this->_table, $this, array('ID_LOGIN' => $post["id_login"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array('ID_LOGIN' => $id));
    }
}
