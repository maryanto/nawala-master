<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->model('Pegawai_login_model');

        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['pegawai'] = $this->Pegawai_model->getAll();
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Data Pegawai';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'pegawai/v_pegawai';
        $this->load->view('admin/v_home', $this->data);
    }

    public function add()
    {
        $Data = $this->Pegawai_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->save();
            $this->session->set_flashdata('sukses', 'Data Pegawai Berhasil disimpan');
        } else {
            $this->session->set_flashdata('gagal', 'Data Pegawai Masuk Gagal disimpan');
        }
        redirect(site_url('admin/pegawai'));
    }

    public function edit()
    {
        $Data = $this->Pegawai_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        if ($validation->run()) {
            $Data->update();
            $this->session->set_flashdata('sukses', 'Data Pegawai Berhasil di ubah');
        }

        redirect(site_url('admin/pegawai'));
    }

    public function hapus($id = null)
    {
        if (!isset($id)) show_404();
        $cekPakai = $this->Pegawai_model->cekPakai($id);
        if ($cekPakai > 0) {
            $this->session->set_flashdata('gagal', 'Data Pegawai Tidak bisa hapus, karena sudah di gunakan di data Login Pegawai');
            redirect(site_url('admin/pegawai'));
        } else {
            if ($this->Pegawai_model->delete($id)) {
                $this->session->set_flashdata('gagal', 'Data Pegawai Berhasil di hapus');
                redirect(site_url('admin/pegawai'));
            }
        }
    }

    //=================login pegawi ==================================

    public function login()
    {
        $this->load->model('Bagian_model');

        $this->data['pegawai'] = $this->Pegawai_model->getAll();
        $this->data['login_pegawai'] = $this->Pegawai_login_model->getPegawai();
        $this->data['bagian'] = $this->Bagian_model->getAll();
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Data Login Pegawai';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'pegawai/v_pegawai_login';
        $this->load->view('admin/v_home', $this->data);
    }

    public function login_add()
    {
        $this->load->library('form_validation');

        $Data = $this->Pegawai_login_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());

        $cekAkun = $this->Pegawai_login_model->cekStatusLogin($this->input->post('id_pegawai'));
        $cekUsername = $this->Pegawai_login_model->cekUsername($this->input->post('username'));

        if ($validation->run() && $cekAkun < 1 && $cekUsername < 1) {
            $Data->save();
            $this->session->set_flashdata('sukses', 'Data Akun Login Pegawai Berhasil disimpan');
        } else {
            $this->session->set_flashdata('gagal', 'Data Akun Login Pegawai Gagal disimpan, karena Data Pegawai tersebut sudah ada di Data Login');
        }
        redirect(site_url('admin/pegawai/login'));
    }

    public function login_edit()
    {
        $this->load->library('form_validation');

        $Data = $this->Pegawai_login_model;
        $validation = $this->form_validation;
        $validation->set_rules($Data->rules());
        $cekUsername = $this->Pegawai_login_model->cekUsername($this->input->post('username'));

        if ($validation->run() && $cekUsername < 1) {
            $Data->update();
            $this->session->set_flashdata('sukses', 'Data Akun Login Pegawai Berhasil di ubah');
        } else {
            $this->session->set_flashdata('gagal', 'Data Akun Login Pegawai Gagal di ubah, karena Data Pegawai tersebut sudah ada di Data Login');
        }

        redirect(site_url('admin/pegawai/login'));
    }

    public function login_hapus($id = null)
    {
        if (!isset($id)) show_404();
        $user = $this->Pegawai_login_model->getById($id);
        $cekPakai = $this->Pegawai_login_model->cekPakaiPegawai($user->ID_PEGAWAI);
        if ($cekPakai > 0) {
            $this->session->set_flashdata('gagal', 'Data Akun Login Pegawai Tidak bisa hapus, karena sudah di gunakan di data disposi surat masuk');
            redirect(site_url('admin/pegawai/login'));
        } else {
            if ($this->Pegawai_login_model->delete($id)) {
                $this->session->set_flashdata('gagal', 'Data Akun Login Pegawai Berhasil di hapus');
                redirect(site_url('admin/pegawai/login'));
            }
        }
    }

    public function cetak()
    {
        $this->data['pegawai'] = $this->Pegawai_model->getAll();
        $this->load->view('pegawai/v_pegawai_cetak', $this->data);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $sheet->setCellValue('A1', "REKAP DATA  PEGAWAI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $Pegawai = $this->Pegawai_model->getAll();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($Pegawai as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->NM_PEGAWAI);
            $sheet->setCellValue('C' . $numrow, $data->ALAMAT);
            $sheet->setCellValue('D' . $numrow, $data->EMAIL);
            $sheet->setCellValue('E' . $numrow, $data->NO_HANDPHONE);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Pegawai");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Pegawai.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
