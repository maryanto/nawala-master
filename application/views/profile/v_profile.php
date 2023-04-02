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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Profile Pengguna</h5>

                        <!-- General Form Elements -->
                        <form method="POST" action="<?= site_url('admin/profile/update') ?>" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" required value="<?= $user->NAME ?>" oninvalid="this.setCustomValidity('Data Nama Pengguna tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" required value="<?= $user->EMAIL ?>" oninvalid="this.setCustomValidity('Data Email Pengguna  tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" required value="<?= $user->USERNAME ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control">
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="foto" id="formFile">
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="<?= $user->USER_ID ?> " />
                            <input type="hidden" name="old_password" value="<?= $user->PASSWORD ?>" />
                            <input type="hidden" name="old_foto" value="<?= $user->FOTO ?> " />

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                                </div>
                            </div>

                            <small class="text-info">Kosongkan kolom password atau foto jika anda tidak ingin merubah password atau foto yang sudah ada.</small>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
    </section>

</main><!-- End #main -->