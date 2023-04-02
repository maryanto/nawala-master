<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Surat_keluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_srt_keluar_model');
        $this->load->model('Surat_keluar_model');
        $this->load->model('Log_surat_keluar_model');
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        if (!$this->Auth_model->current_user()) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['jenis_srt_keluar'] = $this->Jenis_srt_keluar_model->getAll();
        $this->data['surat_keluar'] = $this->Surat_keluar_model->getAll();
        $this->data['draf_surat_keluar'] = $this->Surat_keluar_model->getAllDraft();
        $this->data['judul'] = 'Rekapituasi Surat Keluar';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'surat_keluar/v_surat_keluar';
        $this->load->view('admin/v_home', $this->data);
    }

    public function tampil($id_surat)
    {
        $this->Log_surat_keluar_model->add_log($this->Auth_model->current_user()->USERNAME, $id_surat, "Menampilkan surat keluar");
        $this->data['log_surat'] = $this->Log_surat_keluar_model->getByIdSurat($id_surat);
        $this->data['surat'] = $this->Surat_keluar_model->getById($id_surat);
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Halaman untuk menampilkan surat Keluar';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'surat_keluar/v_surat_keluar_tampil';
        $this->load->view('admin/v_home', $this->data);
    }

    public function draft()
    {
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['jenis_srt_keluar'] = $this->Jenis_srt_keluar_model->getAll();
        $this->data['surat_keluar'] = $this->Surat_keluar_model->getAllDraft();
        $this->data['judul'] = 'Rekapituasi Draf Surat Keluar';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'surat_keluar/v_draf_surat_keluar';
        $this->load->view('admin/v_home', $this->data);
    }

    public function draft_tampil($id_surat)
    {
        $this->load->model('Pegawai_login_model');

        $this->Log_surat_keluar_model->add_log($this->Auth_model->current_user()->USERNAME, $id_surat, "Menampilkan draft surat keluar");
        $this->data['log_surat'] = $this->Log_surat_keluar_model->getByIdSurat($id_surat);
        $this->data['pimpinan'] = $this->Pegawai_login_model->getPimpinan();
        $this->data['surat'] = $this->Surat_keluar_model->getById($id_surat);
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Halaman untuk menampilkan draf surat Keluar';
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'surat_keluar/v_draf_surat_keluar_tampil';
        $this->load->view('admin/v_home', $this->data);
    }

    public function draft_add()
    {
        $data = $this->Surat_keluar_model;
        $validation = $this->form_validation;
        $validation->set_rules($data->rules());

        if ($validation->run()) {
            $data->save_draf();
            $this->session->set_flashdata('sukses', 'Draft surat keluar sudah berhasil di tambahkan.');
        } else {
            $this->session->set_flashdata('gagal', 'Draft surat keluar sudah gagal di tambahkan, periksa kembali isian form yang anda masukkan.');
        }
        redirect(site_url('admin/surat_keluar/draft'));
    }

    public function draft_edit()
    {
        // if (!isset($id)) redirect(site_url('admin/surat_keluar/draft'));

        $data = $this->Surat_keluar_model;
        $validation = $this->form_validation;
        $validation->set_rules($data->rules());

        if ($validation->run()) {
            $data->update_draf();
            $this->session->set_flashdata('sukses', 'Perubahan Draf Surat Keluar sudah berhasil di simpan');
            redirect(site_url('admin/surat_keluar/draft'));
        } else {
            $this->session->set_flashdata('gagal', 'Perubahan Draf Surat Keluar gagal di simpan');
            redirect(site_url('admin/surat_keluar/draft'));
        }
    }

    public function release()
    {
        $data = $this->Surat_keluar_model;
        $validation = $this->form_validation;
        $validation->set_rules($data->rules());

        if ($validation->run()) {
            $data->update();
            $this->session->set_flashdata('sukses', 'Proses relase surat keluar sudah berhasil di lakukan');
            redirect(site_url('admin/surat_keluar'));
        } else {
            $this->session->set_flashdata('gagal', 'Proses relase surat keluar gagal di simpan');
            redirect(site_url('admin/surat_keluar'));
        }
    }



    public function draft_note()
    {
        $id =  $this->input->post('id_surat_keluar');
        if (!isset($id)) redirect(site_url('admin/surat_keluar'));
        $this->Surat_keluar_model->save_note();
        redirect('admin/surat_keluar/draft_tampil/' . $id);
    }

    public function aproved()
    {
        $id_surat_ttd = $this->input->post('id_surat_keluar');
        $tgl_ttd = $this->input->post('tgl_ttd');
        $nm_pimpinan = $this->input->post('nm_pimpinan');

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './upload/'; //string, the default is application/cache/
        $config['errorlog']     = './upload/'; //string, the default is application/logs/
        $config['imagedir']     = './upload/ttd/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id_surat_ttd . '.png'; //buat name dari qr code sesuai dengan nim
        $url_akses = site_url('surat/view/' . $id_surat_ttd);
        $params['data'] = $url_akses; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $this->Surat_keluar_model->save_ttd($id_surat_ttd, $image_name, $tgl_ttd, $nm_pimpinan); //simpan ke database
        // $surat = $this->Surat_keluar_model->getById($id_surat_ttd);
        // $this->M_whatsapp->kirim('087729957039', "Surat yang harus di tanda tangani dengan nomor  :" . $surat->NO_SURAT . " ,tentang :  " . $surat->ISI_SURAT . ", dengan tujuan " . $surat->TUJUAN . " sudah di tandatangi oleh Kepala Sekolah. _Berikut ini adalah pesan otomatis dari server DMS_.");
        // $this->M_whatsapp->kirim('083869644213', "Surat yang harus di tanda tangani dengan nomor  :" . $surat->NO_SURAT . " ,tentang :  " . $surat->ISI_SURAT . ", dengan tujuan " . $surat->TUJUAN . " sudah di tandatangi oleh Kepala Sekolah. _Berikut ini adalah pesan otomatis dari server DMS_.");
        redirect(site_url('admin/surat_keluar/draft_tampil/' . $id_surat_ttd)); //redirect ke halaman rekap tanda tangan surat usai simpan data
    }

    public function draft_hapus($id)
    {
        if (!isset($id)) show_404();
        if ($this->Surat_keluar_model->delete($id)) {
            $this->session->set_flashdata('gagal', 'Draft Surat Keluar sudah berhasil di hapus.');
            redirect(site_url('admin/surat_keluar/draft'));
        }
    }

    public function download($file)
    {
        $surat = $this->Surat_keluar_model->getByFile($file);
        $this->Log_surat_keluar_model->add_log($this->Auth_model->current_user()->USERNAME, $surat->ID_SURAT_KELUAR, "Download surat keluar");

        $this->load->helper('download');
        $path = file_get_contents(base_url() . "upload/surat_keluar/" . $file);
        force_download($file, $path);
    }

    public function rekap()
    {
        $this->data['user'] = $this->Auth_model->current_user();
        $this->data['judul'] = 'Rekapituasi Jumlah Surat Keluar Tahun ' . date('Y');
        $this->data['jumlah_surat'] = $this->Surat_keluar_model->jmlSurat(date('Y'));
        $this->data['menu'] = 'admin/v_menu';
        $this->data['contents'] = 'surat_keluar/v_surat_keluar_rekap';
        $this->load->view('admin/v_home', $this->data);
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
        $sheet->setCellValue('A1', "REKAP DRAF SURAT MASUK"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "No"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "Jenis Surat"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "Tujuan"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "Nomor Surat"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "Kode");
        $sheet->setCellValue('F3', "No Agenda");
        $sheet->setCellValue('G3', "Isi Surat");



        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);



        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $Surat = $this->Surat_keluar_model->getAll();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4

        foreach ($Surat as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->NM_JENIS_SRT_KELUAR);
            $sheet->setCellValue('C' . $numrow, $data->TUJUAN);
            $sheet->setCellValue('D' . $numrow, $data->NO_SURAT);
            $sheet->setCellValue('E' . $numrow, $data->KODE);
            $sheet->setCellValue('F' . $numrow, $data->NO_AGENDA);
            $sheet->setCellValue('G' . $numrow, $data->ISI_SURAT);



            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

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

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Surat Keluar");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Surat Keluar.xlsx"'); // Set nama file excel nya
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
        $sheet->setCellValue('A1', "JUMLAH SURAT KELUAR TAHUN " . date('Y')); // Set kolom A1 dengan tulisan "DATA SISWA"
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

        $Surat = $this->Surat_keluar_model->jmlSurat(date('Y'));
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
        $sheet->setTitle("Rekap Jumlah Surat Keluar");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Jumlah Surat Keluar.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
