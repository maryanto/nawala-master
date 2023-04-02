<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>SIM Surat Masuk & Keluar </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?= $judul ?></a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row">
            <div class="col-lg-12">
                <a href="<?= site_url($this->uri->segment(1) . '/surat_keluar/download/' . $surat->FILE_SURAT) ?>"><button type="button" class="btn btn-primary btn-sm"><i class="bi bi-arrow-down-square"></i> Download File </button></a>
                <a href="<?= site_url($this->uri->segment(1) . '/surat_keluar') ?>"><button type="button" class="btn btn-warning btn-sm"><i class="bi bi-folder-check"></i> Rekap Surat Keluar</button></a>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#tampilLog"><i class="bi bi-card-list"></i> Log Akses </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Status Surat : <?php $status = $surat->STATUS ?>
                            <?php if ($surat->STATUS == '0') : ?>
                                <span class="badge bg-info">draf</span>
                            <?php endif; ?>
                            <?php if ($surat->STATUS == '1') : ?>
                                <span class="badge bg-warning">Belum Release</span>
                            <?php endif; ?>
                            <?php if ($surat->STATUS == '2') : ?>
                                <span class="badge bg-danger">Sudah Relase</span>
                            <?php endif; ?>
                        </h5>

                        <iframe src="<?= base_url() ?>upload/surat_keluar/<?= $surat->FILE_SURAT ?>" width="100%" height="400"></iframe>
                    </div>
                </div>


            </div>
        </div>
    </section>

</main><!-- End #main -->
<!-- Start Tampil Log Surat Masuk Modal-->
<div class="modal fade" id="tampilLog" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Disposisi Surat Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Aktivitas</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($log_surat as $row) { ?>
                            <tr>
                                <td><?= $no++ . '.' ?></td>
                                <td><?= $row->USERNAME ?></td>
                                <td><?= $row->CATATAN ?></td>
                                <td><?= $row->WAKTU ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Tampil Log Surat Masuk Modal-->