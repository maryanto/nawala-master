<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Surat_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Surat_masuk_model');
        $this->load->model('Jenis_srt_masuk_model');
        $this->load->model('Pegawai_login_model');
        $this->load->library('form_validation');
        if (!$this->Pegawai_login_model->current_user() or $this->Pegawai_login_model->current_user()->PIMPINAN != 1) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['rekap_surat'] = $this->Surat_masuk_model->getAll();
        $this->data['jenis_srt_masuk'] = $this->Jenis_srt_masuk_model->getAll();
        $this->data['tujuan'] = $this->Pegawai_login_model->getPimpinan();
        $this->data['user'] = $this->Pegawai_login_model->current_user();
        $this->data['judul'] = 'Rekapitulasi Surat Masuk';
        $this->data['menu'] = 'pimpinan/v_menu';
        $this->data['contents'] = 'surat_masuk/v_surat_masuk';
        $this->load->view('pimpinan/v_home', $this->data);
    }

    public function tampil($id = null)
    {
        $this->load->model('Disposisi_model');
        $this->load->model('Log_surat_masuk_model');

        $this->Log_surat_masuk_model->add_log($this->Pegawai_login_model->current_user()->USERNAME, $id, "Menampilkan surat masuk");
        $this->data['log_surat'] = $this->Log_surat_masuk_model->getByIdSurat($id);
        $this->data['surat'] = $this->Surat_masuk_model->getById($id);
        $this->data['pimpinan'] = $this->Pegawai_login_model->getPimpinan();
        $this->data['bagian'] = $this->Pegawai_login_model->getPegawai();
        $this->data['disposisi'] = $this->Disposisi_model->getBySurat($id);
        $this->data['user'] = $this->Pegawai_login_model->current_user();
        $this->data['judul'] = 'Halaman untuk menampilkan surat';
        $this->data['menu'] = 'pimpinan/v_menu';
        $this->data['contents'] = 'surat_masuk/v_surat_masuk_tampil';
        $this->load->view('pimpinan/v_home', $this->data);
    }

    public function download($file)
    {
        $this->load->model('Log_surat_masuk_model');

        $surat = $this->Surat_masuk_model->getByFile($file);
        $this->Log_surat_masuk_model->add_log($this->Pegawai_login_model->current_user()->USERNAME, $surat->ID_SURAT_MASUK, "Download surat masuk");

        $this->load->helper('download');
        $path = file_get_contents(base_url() . "upload/surat_masuk/" . $file);
        force_download($file, $path);
    }


    public function rekap()
    {
        $this->data['user'] = $this->Pegawai_login_model->current_user();
        $this->data['judul'] = 'Rekapitulasi Jumlah Surat Masuk Tahun ' . date('Y');
        $this->data['jumlah_surat'] = $this->Surat_masuk_model->jmlSurat(date('Y'));
        $this->data['menu'] = 'pimpinan/v_menu';
        $this->data['contents'] = 'surat_masuk/v_surat_masuk_rekap';
        $this->load->view('pimpinan/v_home', $this->data);
    }

    public function cetak()
    {
        $this->data['rekap_surat'] =  $this->Surat_masuk_model->getAll();
        $this->load->view('surat_masuk/v_surat_masuk_cetak', $this->data);
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
        $sheet->setCellValue('A1', "REKAP SURAT MASUK"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "No"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "Nomor Surat"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "Tgl Surat"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "Kode"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "No Agenda"); // Set kolom E3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F3', "Nama Pengirim");
        $sheet->setCellValue('G3', "Tgl Diterima");
        $sheet->setCellValue('H3', "Isi Surat");



        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);


        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $Surat = $this->Surat_masuk_model->getAll();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4

        foreach ($Surat as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->NO_SURAT);
            $sheet->setCellValue('C' . $numrow, date_indo($data->TGL_SURAT));
            $sheet->setCellValue('D' . $numrow, $data->KODE);
            $sheet->setCellValue('E' . $numrow, $data->NO_AGENDA);
            $sheet->setCellValue('F' . $numrow, $data->NM_PENGIRIM);
            $sheet->setCellValue('G' . $numrow, date_indo($data->TGL_DITERIMA));
            $sheet->setCellValue('H' . $numrow, $data->ISI_SURAT);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);



            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('G')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('H')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Surat Masuk");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Surat Masuk.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function export_rekap()
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
        $sheet->setCellValue('A1', "JUMLAH SURAT MASUK TAHUN " . date('Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "No"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "Nama Bulan"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "Jumlah"); // Set kolom C3 dengan tulisan "NAMA"



        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);



        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $Surat = $this->Surat_masuk_model->jmlSurat(date('Y'));
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4

        foreach ($Surat as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->NM_BULAN);
            $sheet->setCellValue('C' . $numrow, $data->JUMLAH);



            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Rekap Jumlah Surat Masuk");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Jumlah Surat Masuk.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
