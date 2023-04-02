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
            <h2>Rekap Data Surat Masuk</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No Surat</th>
                        <th scope="col">Tgl Surat</th>
                        <th scope="col">Pengirim</th>
                        <th scope="col">Isi / Hal</th>
                        <th scope="col">Status Surat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($rekap_surat as $row) { ?>
                        <tr>
                            <th scope="row"><?= $no++ . '.' ?></th>
                            <td><?= $row->NO_SURAT ?></td>
                            <td><?= date_indo($row->TGL_SURAT) ?></td>
                            <td><?= $row->NM_PENGIRIM ?></td>
                            <td><?= $row->ISI_SURAT ?></td>
                            <td><?= nm_status_surat($row->STATUS_SURAT) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main><!-- End #main -->
    <!-- <script>
        window.print();
    </script> -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <!-- <script src="<?= base_url('assets') ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url('assets') ?>/assets/vendor/php-email-form/validate.js"></script>

   
    <script src="<?= base_url('assets') ?>/assets/js/main.js"></script> -->

</body>

</html>