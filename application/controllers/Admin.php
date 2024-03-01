<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Rack_model', 'rak');
        $this->load->model('Book_model', 'book');
        $this->load->model('Category_model', 'kategori');
        $this->load->model('Peminjaman_model', 'pinjam');
        // $this->session->set_userdata('new_role', 'Admin');
        checkLogin('admin');
    }

    public function index()
    {
        $tahun_ini = date('Y');
        $data = [
            'breadcrumb' => "DASHBOARD",
            'js' => 'dashboard.js',
            'count_anggota' => $this->anggota->countAnggota(),
            'count_book' => $this->book->countBook(),
            'count_pinjam' => $this->pinjam->countPinjam(),
            'count_rak' => $this->rak->countRak(),
            'count_stok' => $this->book->countStok(),
            'count_kategori' => $this->kategori->countKategori(),
            'grafik' => $this->pinjam->getJumlahPeminjamanPerBulan($tahun_ini),
            'jumlah_anggota_baru' => $this->anggota->getJumlahAnggotaBaruHariIni(),
            'laporan_pinjam' => $this->pinjam->getJumlahPeminjamHariIni(),
            'jumlah_peminjam_jatuh_tempo' => $this->pinjam->getJumlahPeminjamJatuhTempoHariIni()
        ];


        $this->viewAdmin('index', $data);
    }
}
