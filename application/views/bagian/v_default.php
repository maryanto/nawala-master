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

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Disposisi Surat Masuk <span>| Terbaru</span></h5>

                                <table class="table table-striped">
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
                    </div><!-- End Recent Sales -->



                </div>
            </div><!-- End Left side columns -->



        </div>
    </section>

</main><!-- End #main -->