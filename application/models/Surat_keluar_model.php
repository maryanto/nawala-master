<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar_model extends CI_Model
{

    private $_table = "t_surat_keluar";

    public function rules()
    {
        return [
            [
                'field' => 'id_jenis_srt_keluar',
                'label' => 'Jenis Surat Keluar',
                'rules' => 'required'
            ],

            [
                'field' => 'tujuan',
                'label' => 'Nama Tujuan',
                'rules' => 'required'
            ]
        ];
    }

    public function getJumlah()
    {
        return $this->db->get($this->_table)->num_rows();
    }

    public function getTerbaru()
    {
        $this->db->order_by('TGL_SURAT', 'DESC');
        $this->db->limit(5);
        return $this->db->get_where($this->_table, array('STATUS' => '2'))->result();
    }


    public function getAll()
    {
        $this->db->select('t_surat_keluar.ID_SURAT_KELUAR');
        $this->db->select('t_surat_keluar.ID_JENIS_SRT_KELUAR');
        $this->db->select('r_jenis_srt_keluar.NM_JENIS_SRT_KELUAR');
        $this->db->select('t_surat_keluar.NO_SURAT');
        $this->db->select('t_surat_keluar.NO_AGENDA');
        $this->db->select('t_surat_keluar.KODE');
        $this->db->select('t_surat_keluar.TGL_SURAT');
        $this->db->select('t_surat_keluar.ISI_SURAT');
        $this->db->select('t_surat_keluar.TUJUAN');
        $this->db->select('t_surat_keluar.FILE_SURAT');
        $this->db->select('t_surat_keluar.FILE_TTD');
        $this->db->select('t_surat_keluar.STATUS');
        $this->db->select('t_surat_keluar.CATATAN');
        $this->db->join('r_jenis_srt_keluar', 't_surat_keluar.ID_JENIS_SRT_KELUAR = r_jenis_srt_keluar.ID_JENIS_SRT_KELUAR', 'LEFT');
        $this->db->order_by('t_surat_keluar.ID_SURAT_KELUAR', 'DESC');
        return $this->db->get_where($this->_table, array('t_surat_keluar.STATUS ' => '2'))->result();
    }

    public function getAllDraft()
    {
        $this->db->select('t_surat_keluar.ID_SURAT_KELUAR');
        $this->db->select('t_surat_keluar.ID_JENIS_SRT_KELUAR');
        $this->db->select('r_jenis_srt_keluar.NM_JENIS_SRT_KELUAR');
        $this->db->select('t_surat_keluar.NO_AGENDA');
        $this->db->select('t_surat_keluar.KODE');
        $this->db->select('t_surat_keluar.TGL_SURAT');
        $this->db->select('t_surat_keluar.ISI_SURAT');
        $this->db->select('t_surat_keluar.TUJUAN');
        $this->db->select('t_surat_keluar.FILE_SURAT');
        $this->db->select('t_surat_keluar.FILE_TTD');
        $this->db->select('t_surat_keluar.STATUS');
        $this->db->select('t_surat_keluar.CATATAN');
        $this->db->join('r_jenis_srt_keluar', 't_surat_keluar.ID_JENIS_SRT_KELUAR = r_jenis_srt_keluar.ID_JENIS_SRT_KELUAR', 'LEFT');
        $this->db->order_by('t_surat_keluar.ID_SURAT_KELUAR', 'DESC');
        return $this->db->get_where($this->_table, array('t_surat_keluar.STATUS !=' => '2'))->result();
    }



    public function getById($id)
    {
        return $this->db->get_where($this->_table, array('ID_SURAT_KELUAR' => $id))->row();
    }

    public function getByFile($file)
    {
        return $this->db->get_where($this->_table, array('FILE_SURAT' => $file))->row();
    }

    public function getRelease($id)
    {
        return $this->db->get_where($this->_table, array('ID_SURAT_KELUAR' => $id, 'STATUS' => '2'))->row();
    }

    public function save_draf()
    {
        $post = $this->input->post();
        $this->ID_SURAT_KELUAR = uniqid();
        $this->ID_JENIS_SRT_KELUAR = $post["id_jenis_srt_keluar"];
        $this->TGL_DITERIMA = NULL;
        $this->NO_AGENDA = $post["no_agenda"];
        $this->KODE = $post["kode"];
        $this->NO_SURAT = NULL;
        $this->TGL_SURAT = $post["tgl_surat"];
        $this->ISI_SURAT = $post["isi_surat"];
        $this->TUJUAN = $post["tujuan"];
        $this->FILE_SURAT = $this->_uploadFile();
        $this->FILE_TTD = NULL;
        $this->STATUS = '0';
        $this->TGL_TTD = NULL;
        $this->NM_PIMPINAN = NULL;
        $this->CATATAN = NULL;
        $this->USER_ID = $post["user_id"];
        $this->db->insert($this->_table, $this);
    }

    public function update_draf()
    {
        $post = $this->input->post();
        $this->ID_SURAT_KELUAR = $post["id_surat_keluar"];
        $this->ID_JENIS_SRT_KELUAR = $post["id_jenis_srt_keluar"];
        $this->TGL_DITERIMA = NULL;
        $this->NO_AGENDA = $post["no_agenda"];
        $this->KODE = $post["kode"];
        $this->NO_SURAT = NULL;
        $this->TGL_SURAT = $post["tgl_surat"];
        $this->ISI_SURAT = $post["isi_surat"];
        $this->TUJUAN = $post["tujuan"];
        if (!empty($_FILES["file_surat"]["name"])) {
            $this->_deleteFile($post["id_surat_keluar"]);
            $this->FILE_SURAT = $this->_uploadFile();
        } else {
            $this->FILE_SURAT = $post["old_file_surat"];
        }
        $this->FILE_TTD = NULL;
        $this->STATUS = '0';
        $this->TGL_TTD = NULL;
        $this->NM_PIMPINAN = NULL;
        $this->CATATAN = NULL;
        $this->USER_ID = $post["user_id"];
        $this->db->update($this->_table, $this, array('ID_SURAT_KELUAR' => $post["id_surat_keluar"]));
    }

    public function update()
    {
        $post = $this->input->post();
        $this->ID_SURAT_KELUAR = $post["id_surat_keluar"];
        $this->ID_JENIS_SRT_KELUAR = $post["id_jenis_srt_keluar"];
        $this->TGL_DITERIMA = $post["tgl_diterima"];
        $this->NO_AGENDA = $post["no_agenda"];
        $this->KODE = $post["kode"];
        $this->NO_SURAT = $post["no_surat"];
        $this->TGL_SURAT = $post["tgl_surat"];
        $this->ISI_SURAT = $post["isi_surat"];
        $this->TUJUAN = $post["tujuan"];
        if (!empty($_FILES["file_surat"]["name"])) {
            $this->_deleteFile($post["id_surat_keluar"]);
            $this->FILE_SURAT = $this->_uploadFile();
        } else {
            $this->FILE_SURAT = $post["old_file_surat"];
        }
        $this->STATUS = '2';
        $this->USER_ID = $post["user_id"];
        $this->db->update($this->_table, $this, array('ID_SURAT_KELUAR' => $post["id_surat_keluar"]));
    }

    public function save_ttd($id_surat, $image_name, $tgl, $nama)
    {
        $this->STATUS = '1';
        $this->TGL_TTD = $tgl;
        $this->NM_PIMPINAN = $nama;
        $this->FILE_TTD = $image_name;
        $this->db->update($this->_table, $this, array('ID_SURAT_KELUAR ' => $id_surat));
    }

    public function save_note()
    {
        $post = $this->input->post();
        $this->ID_SURAT_KELUAR = $post["id_surat_keluar"];
        $this->CATATAN = $post["catatan"];
        $this->db->update($this->_table, $this, array('ID_SURAT_KELUAR ' => $post["id_surat_keluar"]));
    }

    private function _uploadFile()
    {
        $config['upload_path']          = './upload/surat_keluar/';
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
        $dok = $this->Surat_keluar_model->getById($id);
        $filename = explode(".", $dok->FILE_SURAT)[0];
        return array_map('unlink', glob(FCPATH . "upload/surat_keluar/$filename.*"));
    }

    private function _deleteFileTTD($id)
    {
        $dok = $this->Surat_keluar_model->getById($id);
        $filename = explode(".", $dok->FILE_TTD)[0];
        return array_map('unlink', glob(FCPATH . "upload/ttd/$filename.*"));
    }

    public function delete($id)
    {
        $this->_deleteFile($id);
        $this->_deleteFileTTD($id);
        return $this->db->delete($this->_table, array('ID_SURAT_KELUAR' => $id));
    }

    public function jmlSurat($tahun)
    {
        $rekap_query = "
        SELECT
        SUBSTR(t_surat_keluar.TGL_SURAT FROM 1 FOR 4) AS TAHUN,
        SUBSTR(t_surat_keluar.TGL_SURAT FROM 6 FOR 2) AS BULAN,
        r_bulan.NM_BULAN,
        COUNT(t_surat_keluar.ID_SURAT_KELUAR) AS JUMLAH
        FROM 
        t_surat_keluar
        LEFT JOIN
        r_bulan ON SUBSTR(t_surat_keluar.TGL_SURAT FROM 6 FOR 2) = r_bulan.KD_BULAN
        WHERE
        SUBSTR(t_surat_keluar.TGL_SURAT FROM 1 FOR 4) = '" . $tahun . "' AND 
        t_surat_keluar.`STATUS` = '2'
        GROUP BY
        SUBSTR(t_surat_keluar.TGL_SURAT FROM 1 FOR 4),
        SUBSTR(t_surat_keluar.TGL_SURAT FROM 6 FOR 2)
        ORDER BY
        SUBSTR(t_surat_keluar.TGL_SURAT FROM 6 FOR 2) ASC
        ";
        $query = $this->db->query($rekap_query)->result();
        return $query;
    }
}
