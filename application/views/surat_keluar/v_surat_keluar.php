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
                <a href="<?= site_url($this->uri->segment(1) . '/surat_keluar/rekap') ?>">
                    <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-card-list"></i> Rekap Jumlah </button>
                </a>
                <a href="<?= site_url($this->uri->segment(1) . '/surat_keluar/export') ?>">
                    <button type="button" class="btn btn-success btn-sm"><i class="bi bi-card-list"></i> Rekap Excel </button>
                </a>
                <a href="<?= site_url($this->uri->segment(1) . '/grafik/keluar') ?>">
                    <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-bar-chart-line"></i> Grafik </button>
                </a>
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
                                <p>Informasi Tentang Surat Keluar</p>
                                <p>Setelah surat keluar di proses pada menu draf surat keluar dan sudah di tanda tangani oleh pimpinan, maka selanjutnya di menu ini di tampilkan pada Tab Draf Surat Keluar dengan Status TTD (sudah di tanda tangani).</p>
                                <p>Proses berikutnya adalah release surat keluar, pada proses ini di lakukan perubahan file lampiran dan juga melengkapi data informasi surat keluar dengan menggunakan menu Relase.</p>
                                <p>Setelah draf surat keluar sudah di relase, maka data surat keluar akan masuk di Tab Surat keluar, dan dengan adanya qr code sebagai tanda tangan digital pimpinan maka ketika pihan penerima surat melakukan scan qr akan di bawa ke halaman informasi surat keluar pada url yang sudah di tetapkan.</p>
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

                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    Draf Surat Keluar
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    Release Surat Keluar
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Jenis Surat</th>
                                            <th scope="col">Tujuan</th>
                                            <th scope="col">Isi / Hal</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($draf_surat_keluar as $row) { ?>
                                            <tr>
                                                <th scope="row"><?= $no++ . '.' ?></th>
                                                <td><?= $row->NM_JENIS_SRT_KELUAR ?></td>
                                                <td><?= $row->TUJUAN ?></td>
                                                <td>
                                                    <?= $row->ISI_SURAT ?><br>

                                                </td>
                                                <td><?= date_indo($row->TGL_SURAT) ?></td>
                                                <td>
                                                    <?php if ($row->STATUS == '0') : ?>
                                                        <button class="btn btn-outline-warning btn-sm">Draf</button>
                                                    <?php endif; ?>
                                                    <?php if ($row->STATUS == '1') : ?>
                                                        <button class="btn btn-outline-success btn-sm">TTD</button>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <?php if ($this->uri->segment(1) == "admin") : ?>
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#releaseModal<?= $row->ID_SURAT_KELUAR ?>" class="btn btn-outline-danger btn-sm" title="Edit Data">
                                                            <i class="bi bi-check2-square"></i> Release
                                                        </button>
                                                    <?php endif; ?>
                                                    <a href="<?= site_url($this->uri->segment(1) . '/surat_keluar/tampil/' . $row->ID_SURAT_KELUAR) ?>">
                                                        <button type="button" class="btn btn-outline-success btn-sm" title="View Data">
                                                            <i class="bi bi-search"></i> Tampil
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Jenis Surat</th>
                                            <th scope="col">Tujuan</th>
                                            <th scope="col">Isi / Hal</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Status</th>
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

                                                </td>
                                                <td><?= date_indo($row->TGL_SURAT) ?></td>
                                                <td>
                                                    <?php if ($row->STATUS == '2') : ?>
                                                        <button class="btn btn-outline-danger btn-sm">Relase</button>
                                                    <?php endif; ?>
                                                </td>

                                                <td>

                                                    <a href="<?= site_url($this->uri->segment(1) . '/surat_keluar/tampil/' . $row->ID_SURAT_KELUAR) ?>">
                                                        <button type="button" class="btn btn-outline-success btn-sm" title="View Data">
                                                            <i class="bi bi-search"></i> Tampil
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
                        <!-- End Default Tabs -->

                    </div>
                </div>


            </div>
        </div>
    </section>

</main><!-- End #main -->
<?php foreach ($draf_surat_keluar as $surat) { ?>
    <!-- End Edit Draf Surat Masuk Modal-->
    <div class="modal fade" id="releaseModal<?= $surat->ID_SURAT_KELUAR ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="<?= site_url('admin/surat_keluar/release') ?>" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Relase Surat Keluar </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-2 col-form-label">Tgl Diterima</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_diterima" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>

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
                            <label for="inputText" class="col-sm-2 col-form-label">Nomor Surat</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_surat" class="form-control" value="" required>
                                <small class="text-danger">Wajib ditambahkan nomor surat keluar</small>
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
                            <label for="inputText" class="col-sm-2 col-form-label">Isi / Hal</label>
                            <div class="col-sm-10">
                                <textarea name="isi_surat" class="form-control" required><?= $surat->ISI_SURAT ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">File Draf Surat </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="file_surat" id="file_surat" required>
                                <small class="text-danger">Wajib di lampirkan surat keluar</small>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="<?= $user->USER_ID ?>" class="form-control">
                        <input type="hidden" name="old_file_surat" value="<?= $surat->FILE_SURAT ?>" class="form-control">
                        <input type="hidden" name="id_surat_keluar" value="<?= $surat->ID_SURAT_KELUAR ?>" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left-square"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-save"></i> Relase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Draf Surat Masuk Modal-->
<?php } ?>