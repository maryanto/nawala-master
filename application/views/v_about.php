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
                <a href="<?= site_url('admin/home') ?>"><button type="button" class="btn btn-primary" title="Home"><i class="bi bi-bank"></i> Home </button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tentang Aplikasi</h5>
                        <p>Sistem Informasi Manajemen Surat Masuk & Surat keluar ini dibuat untuk di gunakan oleh Instansi atau organisasi yang membutuhkan Sistem Informasi Manajemen atau Aplikasi pengelolaan Surat Masuk dan Surat Keluar.</p>
                        <p>Sistem ini berguna untuk mengelola surat masuk, disposisi dan serta surat keluar.</p>
                        <p>Surat Masuk di masukkan di dalam sistem ini menggunakan menu Surat Masuk, kemudian didalam menambahkan surat masuk, kita juga bisa menentukan apakah surat ini perlu di disposisikan atau tidak, dimana untuk surat yang harus di disposisikan ada penanda khusus bawah surat itu harus di disposisi oleh Pimpinan kepada bagian yang di tuju.</p>
                        <p>Untuk surat keluar di mulai dari menambahkan draf surat keluar, kemudian di periksa oleh pimpinan kemudian jika sudah sesuai maka pimpinan bisa melakukan penandatanganan surat secara elektronik dengan menciptakan qr-code dari sistem ini.</p>
                        <p>Setelah surat keluar tercipta, maka surat keluar bisa di tambahkan sebagai surat siap edar dengan menggunakan menu Surat Keluar. </p>
                        <p>Demikian rincian singkat Aplikasi Sistem Informasi Manajemen Surat Masuk dan Keluar yang akan sangat mempermudah instansi atau organisasi dalam mengelola, melacak dan menampilkan surat masuk ataupun surat keluar.</p>
                        <p>Sistem Informasi ini masih sangat mungkin di kembangkan untuk kebutuhan lebih lanjut dengan menghubungi developer.</p>
                        <p>Aplikasi ini di kembangkan oleh Maryanto yang bisa di hubungi di email : m4ryanto@gmail.com</p>
                        <p>Sistem Informasi Manajemen Surat ini juga sangat mungkin untuk di kembangkan menjadi lebih lengkap lagi, misalnya di integrasikan dengan API WhatsApp yang akan mengirimkan pesan ke penerima surat atau disposisi.</p>
                        <p>Terimakasih</p>
                    </div>
                </div>

            </div>


        </div>
    </section>

</main><!-- End #main -->