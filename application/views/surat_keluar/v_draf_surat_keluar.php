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
                                <form method="POST" action="<?= site_url('admin/surat_keluar/draft_add') ?>" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Draf Surat Keluar </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Jenis Surat </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_jenis_srt_keluar">
                                                    <?php foreach ($jenis_srt_keluar as $row) { ?>
                                                        <option value="<?= $row->ID_JENIS_SRT_KELUAR ?>"><?= $row->NM_JENIS_SRT_KELUAR ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Tujuan</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="tujuan" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-2 col-form-label">Tgl Surat</label>
                                            <div class="col-sm-10">
                                                <input type="date" name="tgl_surat" class="form-control" required>
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
                                                <input type="text" name="isi_surat" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-2 col-form-label">File Draf Surat </label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" name="file_surat" id="file_surat" required>
                                            </div>
                                        </div>
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
                    <!-- End Basic Modal-->
                <?php endif; ?>

                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#AboutModal"><i class="bi bi-book-half"></i>
                    Panduan
                </button>
                <div class="modal fade" id="AboutModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Tentang Draf Surat Keluar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Informasi Tentang Draf Surat Keluar</p>
                                <p>Menu Draf Surat Keluar digunakan untuk mengelola draf surat keluar dari suatu instansi / sekolah dimana draf surat keluar di masukkan di Meu Draf Surat keluar ini dan di lanjutkan dengan di berikan catatan koreksi atau Aprove oleh Pimpinan.</p>
                                <p>Jika draf surat keluar sudah di aprove oleh Pimpinan maka akan muncul QR Code sebagai tanda surat sudah bisa di proses menjadi surat keluar.</p>
                                <p>Draf surat keluar yang sudah di aprove atau di tandatangani secara digital oleh pimpinan maka proses selanjutnya di lengkapi atau di proses di menu Surat Keluar.</p>
                                <p>QR COde yang di generate pada proses ini bisa di sematkan pada draf surat di luar sistem ini.</p>
                                <p>Selanjutnya jika draft sudah di setujui dan di aprove oleh pimpinan maka proses berikutnya di lakukan di Surat Keluar.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                            </div>
                        </div>
                    </div>
                </div><!-- End Basic Modal-->
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
                                    <th scope="col">Jenis Surat</th>
                                    <th scope="col">Tujuan</th>
                                    <th scope="col">Isi / Hal</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">QR TTD</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($surat_keluar as $row) { ?>
                                    <tr>
                                        <th scope="row"><?= $no++ . '.' ?></th>
                                        <td><?= $row->NM_JENIS_SRT_KELUAR ?></td>
                                        <td><?= $row->TUJUAN ?></td>
                                        <td>
                                            <?= $row->ISI_SURAT ?><br>
                                            <?php if ($row->CATATAN != NULL) : ?>
                                                <small class="text-danger text-sm-end">(ada catatan pimpinan)</small>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date_indo($row->TGL_SURAT) ?></td>
                                        <td>
                                            <?php if ($row->STATUS == '0') : ?>
                                                <button class="btn btn-warning btn-sm">Draf</button>
                                            <?php endif; ?>
                                            <?php if ($row->STATUS == '1') : ?>
                                                <button class="btn btn-success btn-sm">TTD</button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row->STATUS == '1') : ?>
                                                <img src="<?= base_url('upload/ttd/' . $row->FILE_TTD) ?>" width="100" height="100" />
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($this->uri->segment(1) == "admin") : ?>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#editModal<?= $row->ID_SURAT_KELUAR ?>" class="btn btn-outline-success btn-sm" title="Edit Data">
                                                    <i class="bi bi-check2-square"></i>
                                                </button>
                                                <a href="<?= site_url('admin/surat_keluar/draft_hapus/' . $row->ID_SURAT_KELUAR) ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')"><button type="button" class="btn btn-outline-danger btn-sm" title="Hapus Data">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button></a>
                                            <?php endif; ?>
                                            <a href="<?= site_url($this->uri->segment(1) . '/surat_keluar/draft_tampil/' . $row->ID_SURAT_KELUAR) ?>">
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

<?php foreach ($surat_keluar as $surat) { ?>
    <!-- End Edit Draf Surat Masuk Modal-->
    <div class="modal fade" id="editModal<?= $surat->ID_SURAT_KELUAR ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="<?= site_url('admin/surat_keluar/draft_edit') ?>" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Edit Draf Surat Keluar </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Jenis Surat </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_jenis_srt_keluar">
                                    <?php foreach ($jenis_srt_keluar as $row) { ?>
                                        <option value="<?= $row->ID_JENIS_SRT_KELUAR ?>" <?php if ($row->ID_JENIS_SRT_KELUAR == $surat->ID_JENIS_SRT_KELUAR) {
                                                                                                echo "selected";
                                                                                            } ?>><?= $row->NM_JENIS_SRT_KELUAR ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tujuan</label>
                            <div class="col-sm-10">
                                <input type="text" name="tujuan" class="form-control" value="<?= $surat->TUJUAN ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tgl Surat</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_surat" class="form-control" value="<?= $surat->TGL_SURAT ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" name="kode" class="form-control" value="<?= $surat->KODE ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">No Agenda</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_agenda" class="form-control" value="<?= $surat->NO_AGENDA ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Isi / Hal</label>
                            <div class="col-sm-10">
                                <input type="text" name="isi_surat" class="form-control" value="<?= $surat->ISI_SURAT ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">File Draf Surat </label>
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
                        <input type="hidden" name="old_file_surat" value="<?= $surat->FILE_SURAT ?>" class="form-control">
                        <input type="hidden" name="id_surat_keluar" value="<?= $surat->ID_SURAT_KELUAR ?>" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Draf Surat Masuk Modal-->
<?php } ?>