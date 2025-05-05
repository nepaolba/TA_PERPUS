<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Perpustakaan &rsaquo; SMAN 5 &mdash; KUPANG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

    <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>bower_components/sweetalert2/sweetalert2.min.js"></script>
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="index.html" class="navbar-brand sidebar-gone-hide">Perpustakaan</a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                <form class="form-inline ml-auto">
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <?php $anggota = $this->anggota->getById($this->session->userdata('id')) ?>
                            <div class="d-sm-none d-lg-inline-block"><?= $anggota['nama_anggota'] ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= base_url('Welcome/profil') ?>" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil
                            </a>
                            <a href="<?= base_url('Welcome/daftarPinjam') ?>" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Transaksi
                            </a>

                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('Auth') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> LogIn
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item <?= $this->uri->segment(1) == 'welcome' ? ' active' : '' ?>">
                            <a href="<?= base_url('welcome'); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Beranda</span></a>
                        </li>
                        <li class="nav-item <?= $this->uri->segment(2) == 'koleksi' || $this->uri->segment(2) == 'detailkoleksi'  ? ' active' : '' ?>">
                            <a href="<?= base_url('Welcome/koleksi') ?>" class="nav-link"><i class="far fa-heart"></i><span>Koleksi</span></a>
                        </li>
                        <li class="nav-item <?= $this->uri->segment(2) == 'daftarPinjam'  ? ' active' : '' ?>">
                            <a href="<?= base_url('Welcome/daftarPinjam') ?>" class="nav-link"><i class="far fa-heart"></i><span>Transaksi</span></a>
                        </li>
                        <li class="nav-item <?= $this->uri->segment(2) == 'kartuAnggota'  ? ' active' : '' ?>">
                            <a href="<?= base_url('Welcome/kartuAnggota') ?>" class="nav-link"><i class="far fa-heart"></i><span>Kartu Anggota</span></a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row">