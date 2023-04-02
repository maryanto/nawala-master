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
                <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-arrow-down-square"></i> Download File </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tambahTandaTangan"><i class="bi bi-person-badge"></i> Tanda Tangani </button>
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#tambahCatatan"><i class="bi bi-chat-square-text"></i> Catatan Pimpinan </button>
                <a href="<?= site_url($this->uri->segment(1) . '/surat_keluar/rekap') ?>"><button type="button" class="btn btn-warning btn-sm"><i class="bi bi-folder-check"></i> Rekap Surat Keluar</button></a>
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
                                <span class="badge bg-success">Sudah di tandatangi</span>
                            <?php endif; ?>
                        </h5>

                        <iframe src="<?= base_url() ?>upload/surat_keluar/<?= $surat->FILE_SURAT ?>" width="100%" height="400"></iframe>
                    </div>
                </div>


            </div>
        </div>
    </section>

</main><!-- End #main -->
<!-- Start Modal Tambah Tangan  Modal-->
<div class="modal fade" id="tambahTandaTangan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="<?= site_url($this->uri->segment(1) . '/surat_keluar/aproved') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tanda Tangani Surat Keluar </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Jenis Surat</label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_surat" class="form-control" value="<?= $this->referensi->nmJenisSuratKeluar($surat->ID_JENIS_SRT_KELUAR) ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nomor Surat</label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_surat" class="form-control" value="<?= $surat->NO_SURAT ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" name="kode" class="form-control" value="<?= $surat->KODE ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">No Agenda</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_agenda" class="form-control" value="<?= $surat->NO_AGENDA ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Tujuan </label>
                        <div class="col-sm-10">
                            <input type="text" name="perihal" class="form-control" value="<?= $surat->TUJUAN ?>" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Isi / Hal</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="instruksi" disabled><?= $surat->ISI_SURAT ?></textarea>
                        </div>
                    </div>
                    <?php if ($surat->STATUS == '0') : ?>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tgl Tanda Tangan </label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_ttd" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Pimpinan </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="nm_pimpinan">
                                    <?php foreach ($pimpinan as $row) { ?>
                                        <option value="<?= $row->NM_PEGAWAI ?>"><?= $row->NM_PEGAWAI ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">QR Tanda Tangan</label>
                        <div class="col-sm-10">
                            <?php if ($surat->STATUS == '1') : ?>
                                <img src="<?= base_url('upload/ttd/' . $surat->FILE_TTD) ?>" width="100" height="100" />
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <?php if ($surat->STATUS == '1') : ?>
                                <!-- <button type="button" class="btn btn-outline-success btn-sm">Sudah di tandatangi</button> -->
                                <button type="button" class="btn btn-outline-info btn-sm"><?= $surat->NM_PIMPINAN ?></button>
                                <button type="button" class="btn btn-outline-info btn-sm"><?= date_indo($surat->TGL_TTD) ?></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="hidden" name="id_surat_keluar" value="<?= $surat->ID_SURAT_KELUAR ?>" class="form-control">
                    <?php if ($this->uri->segment(1) == "admin") : ?>
                        <input type="hidden" name="user_id" value="<?= $user->USER_ID ?>" class="form-control">
                    <?php endif; ?>
                    <?php if (!$this->uri->segment(1) != "admin") : ?>
                        <input type="hidden" name="user_id" value="<?= $user->ID_PEGAWAI ?>" class="form-control">
                    <?php endif; ?>
                </div>
                <?php if ($surat->STATUS == '0') : ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save"></i> Tanda Tangani</button>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah Tangan Modal-->
<!-- Start Modal Tambah Tangan  Modal-->
<div class="modal fade" id="tambahCatatan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="<?= site_url($this->uri->segment(1) . '/surat_keluar/draft_note') ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Catatan Pimpinan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Catatan Pimpinan </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="catatan"><?= $surat->CATATAN ?></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="id_surat_keluar" value="<?= $surat->ID_SURAT_KELUAR ?>" class="form-control">
                    <?php if ($this->uri->segment(1) == "admin") : ?>
                        <input type="hidden" name="user_id" value="<?= $user->USER_ID ?>" class="form-control">
                    <?php endif; ?>
                    <?php if ($this->uri->segment(1) != "admin") : ?>
                        <input type="hidden" name="user_id" value="<?= $user->ID_PEGAWAI ?>" class="form-control">
                    <?php endif; ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-save"></i> Simpan Catatan </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- End Modal Tambah Tangan Modal-->

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