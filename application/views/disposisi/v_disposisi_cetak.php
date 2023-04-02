<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Cetak Disposisi | SIM - SUrat</title>
    <meta content="Aplikasi Manajemen Surat Developed By Maryanto" name="description">
    <meta content="surat, aplikasi, web, manajemen, sistem informasi, sim surat, dokumen, dokumen manajemen" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets') ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('assets') ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets') ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="<?= base_url('assets') ?>/assets/css/style.css" rel="stylesheet">

</head>

<body>

    <main>
        <div class="container">
            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <h2>LEMBAR DISPOSISI SURAT MASUK</h2>
                <h3><?= $instansi->NM_INSTANSI ?></h3>
                <h5><?= $instansi->ALAMAT ?></h5>
                <hr>
                <table class="table">
                    <tr>
                        <td width="20%">Status Diposisi</td>
                        <td width="5%">:</td>
                        <td width="75%"><strong><?= nm_status_disposisi($disposisi->STATUS) ?></strong></td>
                    </tr>
                    <tr>
                        <td>Nomor Surat</td>
                        <td>:</td>
                        <td><strong><?= $disposisi->NOMOR_SURAT ?></strong></td>
                    </tr>
                    <tr>
                        <td>Nama Pengirim </td>
                        <td>:</td>
                        <td><strong><?= $disposisi->ASAL ?></strong></td>
                    </tr>
                    <tr>
                        <td>Perihal </td>
                        <td>:</td>
                        <td><strong><?= $disposisi->PERIHAL ?></strong></td>
                    </tr>
                    <tr>
                        <td>Tanggal Diposisi </td>
                        <td>:</td>
                        <td><?= date_indo($disposisi->TANGGAL_DISPOSISI) ?></td>
                    </tr>
                    <tr>
                        <td>Instruksi</td>
                        <td>:</td>
                        <td><?= $disposisi->INSTRUKSI ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Selesai </td>
                        <td>:</td>
                        <td><?= date_indo($disposisi->TANGGAL_SELESAI) ?></td>
                    </tr>
                    <tr>
                        <td>Catatan </td>
                        <td>:</td>
                        <td><?= $disposisi->CATATAN ?></td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td width="33%">Pemberi Disposisi</td>
                        <td width="33%"></td>
                        <td width="33%">Penerima Disposisi</td>
                    </tr>
                    <tr>
                        <td><strong><?= $this->referensi->nmPegawai($disposisi->ID_PEMBERI) ?></strong></td>
                        <td></td>
                        <td><strong><?= $this->referensi->nmPegawai($disposisi->ID_PENERIMA) ?></strong></td>
                    </tr>
                </table>
            </section>

        </div>
    </main><!-- End #main -->
    <script>
        window.print();
    </script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets') ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets') ?>/assets/js/main.js"></script>

</body>

</html>