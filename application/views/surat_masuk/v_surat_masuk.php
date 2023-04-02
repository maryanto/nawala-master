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
                <?php if ($this->uri->segment(1) == "admin") : ?>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="bi bi-save"></i> Tambah </button>
                    <div class="modal fade" id="tambahModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="POST" action="<?= site_url('admin/surat_masuk/add') ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Surat Masuk </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Jenis Surat </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_jenis_srt_masuk">
                                                    <?php foreach ($jenis_srt_masuk as $row) { ?>
                                                        <option value="<?= $row->ID_JENIS_SRT_MASUK ?>"><?= $row->NM_JENIS_SRT_MASUK ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Nama Pengirim</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="nm_pengirim" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">No Surat</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="no_surat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-2 col-form-label">Tgl Surat</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="tgl_surat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-2 col-form-label">Tgl Diterima</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="tgl_diterima" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Kode</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="kode" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">No Agenda</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="no_agenda" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Isi / Hal</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="isi_surat" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Tujuan / Pimpinan</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_tujuan">
                                                    <?php foreach ($tujuan as $row) { ?>
                                                        <option value="<?= $row->ID_PEGAWAI ?>"><?= $row->NM_PEGAWAI ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Status Surat</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status_surat">
                                                    <option value="1">Diteruskan</option>
                                                    <option value="0">Diarsipkan</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-2 col-form-label">File Surat </label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" name="file_surat" id="file_surat">
                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?= $user->USER_ID ?>" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Basic Modal-->
                <?php endif; ?>

                <a href="<?= site_url($this->uri->segment(1) . '/surat_masuk/rekap') ?>">
                    <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-card-list"></i> Rekap Jumlah </button>
                </a>
                <a href="<?= site_url($this->uri->segment(1) . '/surat_masuk/export') ?>">
                    <button type="button" class="btn btn-success btn-sm"><i class="bi bi-card-list"></i> Rekap Excel </button>
                </a>
                <a href="<?= site_url($this->uri->segment(1) . '/surat_masuk/cetak') ?>" target="new"><button type="button" class="btn btn-warning btn-sm" title="Print Data"><i class="bi bi-printer"></i> Print Data</button></a>
                <a href="<?= site_url($this->uri->segment(1) . '/grafik/masuk') ?>">
                    <button type="button" class="btn btn-info btn-sm"><i class="bi bi-bar-chart-line"></i> Grafik </button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $judul ?></h5>

                        <!-- Table with stripped rows -->

                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Tgl Surat</th>
                                    <th scope="col">Pengirim</th>
                                    <th scope="col">Isi / Hal</th>
                                    <th scope="col">Status Surat</th>
                                    <th scope="col">Aksi</th>
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
                                        <td>
                                            <?php if ($this->uri->segment(1) == "admin") : ?>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#editModal<?= $row->ID_SURAT_MASUK ?>" class="btn btn-outline-success btn-sm" title="Edit Data">
                                                    <i class="bi bi-check2-square"></i>
                                                </button>
                                                <a href="<?= site_url('admin/surat_masuk/hapus/' . $row->ID_SURAT_MASUK) ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')"><button type="button" class="btn btn-outline-danger btn-sm" title="Hapus Data">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button></a>

                                                <button type="button" class="btn btn-outline-warning btn-sm" title="Print Data">
                                                    <i class="bi bi-printer"></i>
                                                </button>
                                            <?php endif; ?>
                                            <a href="<?= site_url($this->uri->segment(1) . '/surat_masuk/tampil/' . $row->ID_SURAT_MASUK) ?>">
                                                <button type="button" class="btn btn-outline-info btn-sm" title="View Data">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>


            </div>
        </div>
    </section>

</main><!-- End #main -->
<?php foreach ($rekap_surat as $row) { ?>
    <div class="modal fade" id="editModal<?= $row->ID_SURAT_MASUK ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="<?= site_url('admin/surat_masuk/edit') ?>" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Surat Masuk </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Jenis Surat </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_jenis_srt_masuk">
                                    <?php foreach ($jenis_srt_masuk as $jenis) { ?>
                                        <option value="<?= $jenis->ID_JENIS_SRT_MASUK ?>" <?php if ($jenis->ID_JENIS_SRT_MASUK == $row->ID_JENIS_SRT_MASUK) {
                                                                                                echo "selected";
                                                                                            } ?>><?= $jenis->NM_JENIS_SRT_MASUK ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Pengirim</label>
                            <div class="col-sm-10">
                                <input type="text" name="nm_pengirim" class="form-control" value="<?= $row->NM_PENGIRIM ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">No Surat</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_surat" class="form-control" value="<?= $row->NO_SURAT ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tgl Surat</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_surat" class="form-control" value="<?= $row->TGL_SURAT ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tgl Diterima</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_diterima" class="form-control" value="<?= $row->TGL_DITERIMA ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" name="kode" class="form-control" value="<?= $row->KODE ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">No Agenda</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_agenda" class="form-control" value="<?= $row->NO_AGENDA ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Isi / Hal</label>
                            <div class="col-sm-10">
                                <input type="text" name="isi_surat" class="form-control" value="<?= $row->ISI_SURAT ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tujuan / Pimpinan</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_tujuan">
                                    <?php foreach ($tujuan as $peg) { ?>
                                        <option value="<?= $peg->ID_PEGAWAI ?>"><?= $peg->NM_PEGAWAI ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Status Surat</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="status_surat">
                                    <option value="1" <?php if ($row->STATUS_SURAT == '1') {
                                                            echo "selected";
                                                        } ?>>Diteruskan</option>
                                    <option value="0" <?php if ($row->STATUS_SURAT == '0') {
                                                            echo "selected";
                                                        } ?>>Diarsipkan</option>

                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">File Surat </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="file_surat" id="file_surat">
                            </div>
                        </div>
                        <?php if ($this->uri->segment(1) == "admin") : ?>
                            <input type="hidden" name="user_id" value="<?= $user->USER_ID ?>" class="form-control">
                        <?php endif; ?>
                        <?php if ($this->uri->segment(1) != "admin") : ?>
                            <input type="hidden" name="user_id" value="<?= $user->ID_PEGAWAI ?>" class="form-control">
                        <?php endif; ?>
                        <input type="hidden" name="id_surat_masuk" value="<?= $row->ID_SURAT_MASUK ?>" class="form-control">
                        <input type="hidden" name="old_file_surat" value="<?= $row->FILE_SURAT ?>" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Basic Modal-->