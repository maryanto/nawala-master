<?php

class Auth_model extends CI_Model
{
    private $_table = "t_user";
    const SESSION_KEY = 'USER_ID';

    public function rules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username or Email',
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
                'label' => 'Username or Email',
                'rules' => 'required'
            ]
        ];
    }

    public function login($username, $password)
    {
        $this->db->where('EMAIL', $username)->or_where('USERNAME', $username);
        $query = $this->db->get($this->_table);
        $user = $query->row();

        // cek apakah user sudah terdaftar?
        if (!$user) {
            return FALSE;
        }

        // cek apakah passwordnya benar?
        if (!password_verify($password, $user->PASSWORD)) {
            return FALSE;
        }

        // bikin session
        $this->session->set_userdata([self::SESSION_KEY => $user->USER_ID]);
        $this->_update_last_login($user->USER_ID);

        return $this->session->has_userdata(self::SESSION_KEY);
    }

    public function current_user()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }

        $user_id = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table, ['USER_ID' => $user_id]);
        return $query->row();
    }

    public function logout()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->session->has_userdata(self::SESSION_KEY);
    }

    private function _update_last_login($id)
    {
        $data = [
            'LAST_LOGIN' => date("Y-m-d H:i:s"),
        ];

        return $this->db->update($this->_table, $data, ['USER_ID' => $id]);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, array('USER_ID' => $id))->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->ID_PENGGUNA = uniqid();
        $this->NAME = $post["name"];
        $this->EMAIL = $post["email"];
        $this->USERNAME = $post["username"];
        $this->PASSWORD = password_hash($post["password"], PASSWORD_DEFAULT);
        if (!empty($_FILES["foto"]["name"])) {
            $this->FOTO = $this->_uploadImage();
        } else {
            $this->FOTO = 'no_user.png';
        }
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->USER_ID = $post["user_id"];
        $this->NAME = $post["name"];
        $this->EMAIL = $post["email"];
        $this->USERNAME = $post["username"];
        if ($post["password"] == '') {
            $this->PASSWORD = $post["old_password"];
        } else {
            $this->PASSWORD = password_hash($post["password"], PASSWORD_DEFAULT);
        }
        if (!empty($_FILES["foto"]["name"])) {
            $this->FOTO = $this->_uploadImage();
        } else {
            $this->FOTO = $post["old_foto"];
        }
        $this->db->update($this->_table, $this, array('USER_ID' => $post['user_id']));
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './upload/avatar/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['overwrite']            = true;
        $config['max_size']             = 2024; // 2MB
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }

        print_r($this->upload->display_errors());
    }

    private function _deleteImage($id)
    {
        $user = $this->getById($id);
        if ($user->FOTO != "no_user.png") {
            $filename = explode(".", $user->FOTO)[0];
            return array_map('unlink', glob(FCPATH . "upload/avatar/$filename.*"));
        }
    }


    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table, array('USER_ID' => $id));
    }
}
