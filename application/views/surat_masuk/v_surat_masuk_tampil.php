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
                <!-- Start Notification -->
                <?php if ($this->session->flashdata('sukses')) : ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('sukses') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('gagal')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('gagal') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <!-- End Notification -->

                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahDisposisi"><i class="bi bi-arrow-down-right-square"></i> Tambah Disposisi </button>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tampilDisposisi"><i class="bi bi-back"></i> Tampilkan Disposisi </button>
                <a href="<?= site_url() . "/" . $this->uri->segment('1') . "/surat_masuk/download/" . $surat->FILE_SURAT ?>"><button type="button" class="btn btn-info btn-sm"><i class="bi bi-arrow-down-square"></i> Download File </button></a>
                <a href="<?= site_url() . "/" . $this->uri->segment('1') . "/surat_masuk/rekap" ?>"><button type="button" class="btn btn-warning btn-sm"><i class="bi bi-folder-check"></i> Rekap Surat Masuk</button></a>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#tampilLog"><i class="bi bi-card-list"></i> Log Akses </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nomor Surat : <?= $surat->NO_SURAT ?></h5>
                        <iframe src="<?= base_url() ?>upload/surat_masuk/<?= $surat->FILE_SURAT ?>" width="100%" height="400"></iframe>
                    </div>
                </div>


            </div>
        </div>
    </section>

</main>
<!-- End #main -->
<!-- Start Disposisi Modal-->
<div class="modal fade" id="tambahDisposisi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="<?= site_url($this->uri->segment(1) . '/disposisi/add') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Form Tambah Disposisi </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nomor Surat</label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_surat" class="form-control" value="<?= $surat->NO_SURAT ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Isi / Hal </label>
                        <div class="col-sm-10">
                            <input type="text" name="perihal" class="form-control" value="<?= $surat->ISI_SURAT ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Pengirim </label>
                        <div class="col-sm-10">
                            <input type="text" name="asal" class="form-control" value="<?= $surat->NM_PENGIRIM ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Status Disposisi</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked>
                                <label class="form-check-label" for="inlineRadio1">Biasa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">Penting</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="3">
                                <label class="form-check-label" for="inlineRadio2">Rahasia</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputDate" class="col-sm-2 col-form-label">Tgl Disposisi</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_disposisi" class="form-control" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputDate" class="col-sm-2 col-form-label">Tgl Selesai</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_selesai" class="form-control" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Pemberi Disposisi </label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_pemberi">
                                <?php foreach ($pimpinan as $row) { ?>
                                    <option value="<?= $row->ID_PEGAWAI ?>"><?= $row->NM_PEGAWAI ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Penerima Disposisi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_penerima">
                                <?php foreach ($bagian as $row) { ?>
                                    <option value="<?= $row->ID_PEGAWAI ?>"><?= $row->NM_PEGAWAI ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Instruksi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="instruksi" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Catatan</label>
                        <div class="col-sm-10">
                            <input type="text" name="catatan" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="id_surat_masuk" value="<?= $surat->ID_SURAT_MASUK ?>" class="form-control">
                    <input type="hidden" name="is_read" value="0" class="form-control">
                    <?php if ($this->uri->segment(1) == "admin") : ?>
                        <input type="hidden" name="user_id" value="<?= $user->USER_ID ?>" class="form-control">
                    <?php endif; ?>
                    <?php if ($this->uri->segment(1) != "admin") : ?>
                        <input type="hidden" name="user_id" value="<?= $user->ID_PEGAWAI ?>" class="form-control">
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Disposisi Modal-->

<!-- Start Tampil Disposisi Modal-->
<div class="modal fade" id="tampilDisposisi" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Disposisi Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pemberi Disposisi</th>
                            <th>Penerima Disposisi</th>
                            <th>Tgl Disposisi</th>
                            <th>Tgl Selesai</th>
                            <th>Instruksi</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($disposisi as $row) { ?>
                            <tr>
                                <td><?= $no++ . '.' ?></td>
                                <td><?= $this->referensi->nmPegawai($row->ID_PEMBERI) ?></td>
                                <td><?= $this->referensi->nmPegawai($row->ID_PENERIMA) ?></td>
                                <td><?= date_indo($row->TANGGAL_DISPOSISI) ?></td>
                                <td><?= date_indo($row->TANGGAL_SELESAI) ?></td>
                                <td><?= $row->INSTRUKSI ?></td>
                                <td><?= $row->CATATAN ?></td>
                                <td>
                                    <a href="<?= site_url($this->uri->segment(1) . '/disposisi/hapus/' . $surat->ID_SURAT_MASUK . '/' . $row->ID_DISPOSISI) ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')"><button type="button" class="btn btn-outline-danger btn-sm" title="Hapus Data">
                                            <i class="bi bi-trash-fill"></i>
                                        </button></a>
                                    <a href="<?= site_url($this->uri->segment(1) . '/disposisi/cetak/' . $row->ID_DISPOSISI) ?>" target="new"><button type="button" class="btn btn-outline-warning btn-sm" title="Print Data">
                                            <i class="bi bi-printer"></i>
                                        </button></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Tampil Disposisi Modal-->

<!-- Start Tampil Log Surat Masuk Modal-->
<div class="modal fade" id="tampilLog" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Disposisi Surat Masuk</h5>
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