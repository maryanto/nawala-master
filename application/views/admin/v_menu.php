<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="<?= site_url('admin/home') ?>">
                <i class="bi bi-bank"></i>
                <span>Home</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Master Aplikasi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= site_url('admin/instansi') ?>">
                        <i class="bi bi-circle"></i><span>Instansi</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/bagian') ?>">
                        <i class="bi bi-circle"></i><span>Bagian</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/jenis_srt_masuk') ?>">
                        <i class="bi bi-circle"></i><span>Jenis Surat Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/jenis_srt_keluar') ?>">
                        <i class="bi bi-circle"></i><span>Jenis Surat Keluar</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/pegawai') ?>">
                        <i class="bi bi-circle"></i><span>Pegawai</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/pimpinan') ?>">
                        <i class="bi bi-circle"></i><span>Pimpinan</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/pegawai/login') ?>">
                        <i class="bi bi-circle"></i><span>Login Pegawai</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Surat Masuk</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= site_url('admin/surat_masuk') ?>">
                        <i class="bi bi-circle"></i><span>Surat Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/disposisi') ?>">
                        <i class="bi bi-circle"></i><span>Disposisi</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav2" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Surat Keluar</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= site_url('admin/surat_keluar/draft') ?>">
                        <i class="bi bi-circle"></i><span>Draf Surat Keluar</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/surat_keluar') ?>">
                        <i class="bi bi-circle"></i><span>Surat Keluar</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Rekap & Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= site_url('admin/surat_masuk/rekap') ?>">
                        <i class="bi bi-circle"></i><span>Rekap Surat Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/disposisi/rekap') ?>">
                        <i class="bi bi-circle"></i><span>Rekap Disposisi</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/surat_keluar/rekap') ?>">
                        <i class="bi bi-circle"></i><span>Rekap Surat Keluar</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Grafik</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= site_url('admin/grafik/masuk') ?>">
                        <i class="bi bi-circle"></i><span>Surat Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/grafik/disposisi') ?>">
                        <i class="bi bi-circle"></i><span>Disposisi</span>
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/grafik/keluar') ?>">
                        <i class="bi bi-circle"></i><span>Surat Keluar</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= site_url('admin/profile') ?>">
                <i class="bi bi-gear"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= site_url('admin/about') ?>">
                <i class="bi bi-envelope"></i>
                <span>Tentang</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= site_url('auth/logout') ?>">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Keluar</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>
</aside><!-- End Sidebar-->