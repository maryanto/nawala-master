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
                <a href="<?= site_url($this->uri->segment(1) . '/disposisi/rekap') ?>">
                    <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-card-list"></i> Rekap Jumlah </button>
                </a>
                <a href="<?= site_url($this->uri->segment(1) . '/grafik/disposisi') ?>">
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
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>Pengirim</th>
                                    <th>Isi / Hal</th>
                                    <th>Pemberi Disposisi</th>
                                    <th>Penerima Disposisi</th>
                                    <th>Tgl Disposisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($disposisi as $row) { ?>
                                    <tr>
                                        <td><?= $no++ . '.' ?></td>
                                        <td><?= $row->NOMOR_SURAT ?></td>
                                        <td><?= $row->ASAL ?></td>
                                        <td><?= $row->PERIHAL ?></td>
                                        <td><?= $this->referensi->nmPegawai($row->ID_PEMBERI) ?></td>
                                        <td><?= $this->referensi->nmPegawai($row->ID_PENERIMA) ?></td>
                                        <td><?= date_indo($row->TANGGAL_DISPOSISI) ?></td>
                                        <td>

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
    </section>

</main><!-- End #main -->