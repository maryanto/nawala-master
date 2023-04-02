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

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bi bi-save"></i>
                    Tambah
                </button>
                <div class="modal fade" id="basicModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="<?= site_url('admin/jenis_srt_masuk/add') ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Nama Jenis Surat Masuk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="nm_jenis_srt_masuk" class="form-control" placeholder="Nama Jenis Surat Masuk" required />
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
                <!-- <button type="button" class="btn btn-success" title="Export Data"><i class="bi bi-box-arrow-in-down-right"></i> Export Excel </button>
                <button type="button" class="btn btn-warning" title="Print Data"><i class="bi bi-printer"></i> Print Data</button> -->
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#AboutModal"><i class="bi bi-book-half"></i>
                    Panduan
                </button>
                <div class="modal fade" id="AboutModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Tentang Jenis Surat Masuk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Informasi Tentang Menu Jenis Surat Masuk</p>
                                <p>Jenis Surat Masuk adalah referensi untuk jenis surat masuk yang akan di gunakan sebagai pengelompokan jenis surat masuk di data surat masuk.</p>
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
                                    <th scope="col">Name</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($jenis_masuk as $row) { ?>
                                    <tr>
                                        <th scope="row"><?= $no++ . '.' ?></th>
                                        <td><?= $row->NM_JENIS_SRT_MASUK ?></td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#EditModal<?= $row->ID_JENIS_SRT_MASUK ?>" class="btn btn-outline-success" title="Edit Data">
                                                <i class="bi bi-check2-square"></i>
                                            </button>
                                            <a href="<?= site_url('admin/jenis_srt_masuk/hapus/' . $row->ID_JENIS_SRT_MASUK) ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')">
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

<?php foreach ($jenis_masuk as $row) { ?>
    <div class="modal fade" id="EditModal<?= $row->ID_JENIS_SRT_MASUK ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?= site_url('admin/jenis_srt_masuk/edit') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Nama Bagian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="nm_jenis_srt_masuk" class="form-control" placeholder="Nama Jenis Surat Masuk" value="<?= $row->NM_JENIS_SRT_MASUK ?>" required />
                        <input type="hidden" name="id_jenis_srt_masuk" class="form-control" value="<?= $row->ID_JENIS_SRT_MASUK ?>" required />

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Basic Modal-->
<?php } ?>