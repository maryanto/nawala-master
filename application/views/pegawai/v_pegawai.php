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

                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bi bi-save"></i> Tambah </button>
                <div class="modal fade" id="basicModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="<?= site_url('admin/pegawai/add') ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pegawai</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Nama Pegawai</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nm_pegawai" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="alamat" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">No Handphone</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="no_handphone" class="form-control" required>
                                        </div>
                                    </div>
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
                <a href="<?= site_url($this->uri->segment(1) . '/pegawai/export') ?>"><button type="button" class="btn btn-success  btn-sm" title="Export Data"><i class="bi bi-box-arrow-in-down-right"></i> Export Excel </button></a>
                <a href="<?= site_url($this->uri->segment(1) . '/pegawai/cetak') ?>" target="new"><button type="button" class="btn btn-warning  btn-sm" title="Print Data"><i class="bi bi-printer"></i> Print Data</button></a>
                <a href="<?= site_url('admin/pegawai/login') ?>"><button type="button" class="btn btn-danger  btn-sm"><i class="bi bi-person-badge"></i> Login Pegawai </button></a>
                <button type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal" data-bs-target="#AboutModal"><i class="bi bi-book-half"></i>
                    Panduan
                </button>
                <div class="modal fade" id="AboutModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Tentang Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Informasi Tentang Menu Pegawai</p>
                                <p>Menu data pegawai ini digunakan untuk mengelola data pegawai yang ada di instansi ini, data pegawai yang di masukkan di data ini adalah pegawai yang akan terlibat di dalam aktivitas per suratan ini.</p>
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
                                    <th scope="col">Nama Pegawai</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No Handphone</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($pegawai as $row) { ?>
                                    <tr>
                                        <td scope="row"><?= $no++ . '.' ?></td>
                                        <td><?= $row->NM_PEGAWAI ?></td>
                                        <td><?= $row->ALAMAT ?></td>
                                        <td><?= $row->EMAIL ?></td>
                                        <td><?= $row->NO_HANDPHONE ?></td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#editModal<?= $row->ID_PEGAWAI ?>" class="btn btn-outline-success" title="Edit Data">
                                                <i class="bi bi-check2-square"></i>
                                            </button>
                                            <a href="<?= site_url('admin/pegawai/hapus/' . $row->ID_PEGAWAI) ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')">
                                                <button type="button" class="btn btn-outline-danger" title="Hapus Data">
                                                    <i class="bi bi-trash-fill"></i>
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

<?php foreach ($pegawai as $row) { ?>
    <div class="modal fade" id="editModal<?= $row->ID_PEGAWAI ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?= site_url('admin/pegawai/edit') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-10">
                                <input type="text" name="nm_pegawai" class="form-control" value="<?= $row->NM_PEGAWAI ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" name="alamat" class="form-control" value="<?= $row->ALAMAT ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="<?= $row->EMAIL ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">No Handphone</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_handphone" value="<?= $row->NO_HANDPHONE ?>" class="form-control" required>
                            </div>
                        </div>
                        <input type="hidden" name="id_pegawai" value="<?= $row->ID_PEGAWAI ?>" />
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