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

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Surat <span>| Masuk</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $jmlSuratMasuk ?></h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">



                            <div class="card-body">
                                <h5 class="card-title">Surat <span>| Keluar</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $jmlSuratKeluar ?></h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-4">

                        <div class="card info-card customers-card">



                            <div class="card-body">
                                <h5 class="card-title">Disposisi <span>| Surat Masuk</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box-arrow-in-down-right"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $jmlDisposisi ?></h6>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->


                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Surat Masuk <span>| Terbaru</span></h5>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">No Surat</th>
                                            <th scope="col">Tgl Surat</th>
                                            <th scope="col">Pengirim</th>
                                            <th scope="col">Isi / Hal</th>
                                            <th scope="col">Status Surat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($surat_masuk as $row) { ?>
                                            <tr>
                                                <th scope="row"><?= $no++ . '.' ?></th>
                                                <td><?= $row->NO_SURAT ?></td>
                                                <td><?= date_indo($row->TGL_SURAT) ?></td>
                                                <td><?= $row->NM_PENGIRIM ?></td>
                                                <td><?= $row->ISI_SURAT ?></td>
                                                <td><?= nm_status_surat($row->STATUS_SURAT) ?></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">


                            <div class="card-body pb-0">
                                <h5 class="card-title">Surat Keluar <span>| Terbaru</span></h5>

                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Jenis Surat</th>
                                            <th scope="col">Tujuan</th>
                                            <th scope="col">Isi / Hal</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($surat_keluar as $row) { ?>
                                            <tr>
                                                <th scope="row"><?= $no++ . '.' ?></th>
                                                <td><?= $this->referensi->nmJenisSuratKeluar($row->ID_JENIS_SRT_KELUAR) ?></td>
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


                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->



        </div>
    </section>

</main><!-- End #main -->