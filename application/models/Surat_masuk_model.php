<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk_model extends CI_Model
{

    private $_table = "t_surat_masuk";

    public function rules()
    {
        return [
            [
                'field' => 'id_jenis_srt_masuk',
                'label' => 'Jenis Surat Masuk',
                'rules' => 'required'
            ],

            [
                'field' => 'nm_pengirim',
                'label' => 'Nama Pengirim',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        $this->db->order_by('TGL_DITERIMA', 'DESC');
        return $this->db->get($this->_table)->result();
    }

    public function getJumlah()
    {
        return $this->db->get($this->_table)->num_rows();
    }

    public function getTerbaru()
    {
        $this->db->order_by('TGL_DITERIMA', 'DESC');
        $this->db->limit(5);
        return $this->db->get($this->_table)->result();
    }


    public function getById($id)
    {
        return $this->db->get_where($this->_table, array('ID_SURAT_MASUK' => $id))->row();
    }

    public function getByFile($file)
    {
        return $this->db->get_where($this->_table, array('FILE_SURAT' => $file))->row();
    }

    public function getByIdAkses($id)
    {
        $where = array('ID_BAGIAN' => $id);
        $this->db->order_by('ID_SURAT_MASUK', 'DESC');
        return $this->db->get_where($this->_table, $where)->result();
    }

    public function cekPakai($id)
    {
        return $this->db->get_where('t_disposisi', array('ID_SURAT_MASUK' => $id))->num_rows();
    }

    public function getAllBelumDisposisi()
    {
        $query_rekap = "
        SELECT * FROM t_surat_masuk WHERE NOT EXISTS (SELECT * FROM t_disposisi WHERE t_surat_masuk.ID_SURAT_MASUK = t_disposisi.ID_SURAT_MASUK) AND STATUS_SURAT = '1' ORDER BY ID_SURAT_MASUK DESC;
        ";
        $query = $this->db->query($query_rekap);
        return $query->result();
    }

    public function getByAksesStatus($id, $sts) //rekap surat berdasarkan id bgian dan status surat
    {
        $where = array(
            'ID_BAGIAN' => $id,
            'STATUS_SURAT' => $sts
        );
        $this->db->order_by('TGL_DITERIMA', 'DESC');
        return $this->db->get_where($this->_table, $where)->result();
    }

    public function getTglAkses($id, $tgl)
    {
        $where = array(
            'ID_BAGIAN' => $id,
            'TGL_DITERIMA' => $tgl
        );
        $this->db->order_by('ID_SURAT_MASUK', 'DESC');
        return $this->db->get_where($this->_table, $where)->result();
    }

    public function getByTanggal($tgl)
    {
        $where = array(
            'TGL_DITERIMA' => $tgl
        );
        $this->db->order_by('ID_SURAT_MASUK', 'DESC');
        return $this->db->get_where($this->_table, $where)->result();
    }


    public function save()
    {
        $post = $this->input->post();
        $this->ID_SURAT_MASUK = uniqid();
        $this->ID_JENIS_SRT_MASUK = $post["id_jenis_srt_masuk"];
        $this->KODE = $post["kode"];
        $this->NO_AGENDA = $post["no_agenda"];
        $this->NM_PENGIRIM = $post["nm_pengirim"];
        $this->NO_SURAT = $post["no_surat"];
        $this->TGL_SURAT = $post["tgl_surat"];
        $this->TGL_DITERIMA = $post["tgl_diterima"];
        $this->ISI_SURAT = $post["isi_surat"];
        $this->STATUS_SURAT = $post["status_surat"];
        $this->FILE_SURAT = $this->_uploadFile();
        $this->ID_TUJUAN = $post["id_tujuan"];
        $this->USER_ID = $post["user_id"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_SURAT_MASUK = $post["id_surat_masuk"];
        $this->ID_JENIS_SRT_MASUK = $post["id_jenis_srt_masuk"];
        $this->KODE = $post["kode"];
        $this->NO_AGENDA = $post["no_agenda"];
        $this->NM_PENGIRIM = $post["nm_pengirim"];
        $this->NO_SURAT = $post["no_surat"];
        $this->TGL_SURAT = $post["tgl_surat"];
        $this->TGL_DITERIMA = $post["tgl_diterima"];
        $this->ISI_SURAT = $post["isi_surat"];
        $this->STATUS_SURAT = $post["status_surat"];
        if (!empty($_FILES["file_surat"]["name"])) {
            $this->FILE_SURAT = $this->_uploadFile();
        } else {
            $this->FILE_SURAT = $post["old_file_surat"];
        }
        $this->ID_TUJUAN = $post["id_tujuan"];
        $this->USER_ID = $post["user_id"];
        $this->db->update($this->_table, $this, array('ID_SURAT_MASUK' => $post["id_surat_masuk"]));
    }

    private function _uploadFile()
    {
        $config['upload_path']          = './upload/surat_masuk/';
        $config['allowed_types']        = 'rtf|doc|docx|pdf';
        $config['overwrite']            = true;
        $config['max_size']             = 10024; // 1MB
        $config['encrypt_name']            = TRUE;
        //$config['file_name']            = $this->ID_USER;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_surat')) {
            return $this->upload->data("file_name");
        }

        print_r($this->upload->display_errors());
    }

    private function _deleteFile($id)
    {
        $dok = $this->Surat_masuk_model->getById($id);
        $filename = explode(".", $dok->FILE_SURAT)[0];
        return array_map('unlink', glob(FCPATH . "upload/surat_masuk/$filename.*"));
    }

    public function delete($id)
    {
        $this->_deleteFile($id);
        return $this->db->delete($this->_table, array('ID_SURAT_MASUK' => $id));
    }

    public function jmlSurat($tahun)
    {
        $rekap_query = "
        SELECT
        SUBSTR(t_surat_masuk.TGL_SURAT FROM 1 FOR 4) AS TAHUN,
        SUBSTR(t_surat_masuk.TGL_SURAT FROM 6 FOR 2) AS BULAN,
        r_bulan.NM_BULAN,
        COUNT(t_surat_masuk.ID_SURAT_MASUK) AS JUMLAH
        FROM 
        t_surat_masuk
        LEFT JOIN
        r_bulan ON SUBSTR(t_surat_masuk.TGL_SURAT FROM 6 FOR 2) = r_bulan.KD_BULAN
        WHERE
        SUBSTR(t_surat_masuk.TGL_SURAT FROM 1 FOR 4) = '" . $tahun . "'
        GROUP BY
        SUBSTR(t_surat_masuk.TGL_SURAT FROM 1 FOR 4),
        SUBSTR(t_surat_masuk.TGL_SURAT FROM 6 FOR 2)
        ORDER BY
        SUBSTR(t_surat_masuk.TGL_SURAT FROM 6 FOR 2) ASC
        ";
        $query = $this->db->query($rekap_query)->result();
        return $query;
    }
}
