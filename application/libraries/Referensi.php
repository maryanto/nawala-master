<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Referensi
{
    function nmPegawai($id)
    {
        $this->ci = &get_instance();
        $where = array(
            'ID_PEGAWAI' => $id
        );
        $hasil = $this->ci->db->get_where('t_pegawai', $where)->row();
        if ($hasil != NULL) {
            return $hasil->NM_PEGAWAI;
        } else {
            $hasil = '';
        }
    }

    function nmBagian($id)
    {
        $this->ci = &get_instance();
        $where = array(
            'ID_BAGIAN' => $id
        );
        $hasil = $this->ci->db->get_where('r_bagian', $where)->row();
        if ($hasil != NULL) {
            return $hasil->NM_BAGIAN;
        } else {
            $hasil = '';
        }
    }

    function nmJenisSuratKeluar($id)
    {
        $this->ci = &get_instance();
        $where = array(
            'ID_JENIS_SRT_KELUAR' => $id
        );
        $hasil = $this->ci->db->get_where('r_jenis_srt_keluar', $where)->row();
        if ($hasil != NULL) {
            return $hasil->NM_JENIS_SRT_KELUAR;
        } else {
            $hasil = '';
        }
    }

    function jmlSuratMasuk($bulan, $tahun)
    {
        $this->ci = &get_instance();
        $tanggal = $tahun . "-" . $bulan . "-%";
        $where = array(
            'TGL_SURAT LIKE' => $tanggal
        );
        $hasil = $this->ci->db->get_where('t_surat_masuk', $where)->num_rows();
        if ($hasil != NULL) {
            return $hasil;
        } else {
            $hasil = '0';
        }
    }

    function jmlSuratDisposisi($bulan, $tahun)
    {
        $this->ci = &get_instance();
        $tanggal = $tahun . "-" . $bulan . "-%";
        $where = array(
            'TANGGAL_DISPOSISI LIKE' => $tanggal
        );
        $hasil = $this->ci->db->get_where('t_disposisi', $where)->num_rows();
        if ($hasil != NULL) {
            return $hasil;
        } else {
            $hasil = '0';
        }
    }

    function jmlSuratKeluar($bulan, $tahun)
    {
        $this->ci = &get_instance();
        $tanggal = $tahun . "-" . $bulan . "-%";
        $where = array(
            'TGL_SURAT LIKE' => $tanggal,
            'STATUS' => '2'
        );
        $hasil = $this->ci->db->get_where('t_surat_keluar', $where)->num_rows();
        if ($hasil != NULL) {
            return $hasil;
        } else {
            $hasil = '0';
        }
    }
}
