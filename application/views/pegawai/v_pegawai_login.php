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
                            <form method="POST" action="<?= site_url('admin/pegawai/login_add') ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title">Penentuan Akun Login Pegawai </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Nama Pegawai</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_pegawai">
                                                <?php foreach ($pegawai as $row) { ?>
                                                    <option value="<?= $row->ID_PEGAWAI ?>"><?= $row->NM_PEGAWAI ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Nama Bagian</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_bagian">
                                                <?php foreach ($bagian as $row) { ?>
                                                    <option value="<?= $row->ID_BAGIAN ?>"><?= $row->NM_BAGIAN ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="password" class="form-control" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="pimpinan" value="0" class="form-control">
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
                <a href="<?= site_url('admin/pegawai') ?>"><button type="button" class="btn btn-danger btn-sm"><i class="bi bi-person-badge"></i> Data Pegawai </button></a>
                <!-- <button type="button" class="btn btn-success" title="Export Data"><i class="bi bi-box-arrow-in-down-right"></i> Export Excel </button>
                <button type="button" class="btn btn-warning" title="Print Data"><i class="bi bi-printer"></i> Print Data</button> -->
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
                                    <th scope="col">Username</th>
                                    <th scope="col">Bagian</th>
                                    <th scope="col">Status Aktif</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($login_pegawai as $row) { ?>
                                    <tr>
                                        <th scope="row"><?= $no++ . '.' ?></th>
                                        <td><?= $row->NM_PEGAWAI ?></td>
                                        <td><?= $row->USERNAME ?></td>
                                        <td><?= $this->referensi->nmBagian($row->ID_BAGIAN) ?></td>
                                        <td><?php $aktif =  $row->AKTIF;
                                            if ($aktif == '1') {
                                                echo "Aktif";
                                            } else {
                                                echo "Tidak Aktif";
                                            } ?></td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#editModal<?= $row->ID_LOGIN ?>" class="btn btn-outline-success" title="Edit Data">
                                                <i class="bi bi-check2-square"></i>
                                            </button>
                                            <a href="<?= site_url('admin/pegawai/login_hapus/' . $row->ID_LOGIN) ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')"><button type="button" class="btn btn-outline-danger" title="Hapus Data">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button></a>
                                            <!-- <button type="button" class="btn btn-outline-warning" title="Print Data">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-info" title="View Data">
                                                <i class="bi bi-search"></i>
                                            </button> -->
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

<?php foreach ($login_pegawai as $edit) { ?>
    <div class="modal fade" id="editModal<?= $edit->ID_LOGIN ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?= site_url('admin/pegawai/login_edit') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Penentuan Akun Login Pegawai </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_pegawai">
                                    <?php foreach ($pegawai as $data) { ?>
                                        <option value="<?= $data->ID_PEGAWAI ?>" <?php if ($data->ID_PEGAWAI == $edit->ID_PEGAWAI) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $data->NM_PEGAWAI ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Bagian</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_bagian">
                                    <?php foreach ($bagian as $data_r) { ?>
                                        <option value="<?= $data_r->ID_BAGIAN ?>" <?php if ($data_r->ID_BAGIAN == $edit->ID_BAGIAN) {
                                                                                        echo "selected";
                                                                                    } ?>><?= $data_r->NM_BAGIAN ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" value="<?= $edit->USERNAME ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Status Aktif</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="aktif">
                                    <option value="1" <?php if ($edit->AKTIF == '1') {
                                                            echo "selected";
                                                        } ?>>Aktif</option>
                                    <option value="0" <?php if ($edit->AKTIF == '0') {
                                                            echo "selected";
                                                        } ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="old_password" value="<?= $edit->PASSWORD ?>" class="form-control">
                        <input type="hidden" name="id_login" value="<?= $edit->ID_LOGIN ?>" class="form-control">
                        <input type="hidden" name="id_bagian" value="0" class="form-control">
                        <input type="hidden" name="pimpinan" value="1" class="form-control">
                        <small class="text-danger">Kosongkan kolom pasword jika tidak ingin merubah password yang ada.</small>
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