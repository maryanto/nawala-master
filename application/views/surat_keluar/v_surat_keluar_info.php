<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Informasi Surat Keluar | SIM Surat NAWALA</title>
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
                <h2>INFORMASI - VALIDASI SURAT KELUAR</h2>
                <h3><?= $instansi->NM_INSTANSI ?></h3>
                <h5><?= $instansi->ALAMAT ?></h5>
                <hr>
                <table class="table">
                    <tr>
                        <td>Nomor Surat</td>
                        <td>:</td>
                        <td><strong><?= $surat_keluar->NO_SURAT ?></strong></td>
                    </tr>

                    <tr>
                        <td>Tanggal Surat </td>
                        <td>:</td>
                        <td><?= date_indo($surat_keluar->TGL_SURAT) ?></td>
                    </tr>
                    <tr>
                        <td>Kepada </td>
                        <td>:</td>
                        <td><?= $surat_keluar->TUJUAN ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Tandatangan </td>
                        <td>:</td>
                        <td><?= date_indo($surat_keluar->TGL_TTD) ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pimpinan </td>
                        <td>:</td>
                        <td><?= $surat_keluar->NM_PIMPINAN ?></td>
                    </tr>
                </table>

            </section>

        </div>
    </main><!-- End #main -->

    <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  
    <script src="<?= base_url('assets') ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/php-email-form/validate.js"></script> -->

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets') ?>/assets/js/main.js"></script>

</body>

</html>