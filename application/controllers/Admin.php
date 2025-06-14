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
        $this->load->model('Pengembalian_model', 'kembali');
        $this->load->model('Profil_model', 'profil');
        // $this->session->set_userdata('new_role', 'Admin');
        checkLogin('admin');
    }

    public function index()
    {
        $tahun = date('Y');
        $data_db = $this->pinjam->getJumlahPeminjamanPerBulan($tahun);
        // Inisialisasi array kosong 12 bulan (1–12)
        $peminjaman = array_fill(1, 12, 0);
        $pengembalian = array_fill(1, 12, 0);

        // Isi data peminjaman
        foreach ($data_db['peminjaman'] as $item) {
            if (isset($item['bulan'])) {
                $bulan = (int) $item['bulan'];
                $peminjaman[$bulan] = (int) $item['jumlah'];
            }
        }

        // Isi data pengembalian
        foreach ($data_db['pengembalian'] as $item) {
            if (isset($item['bulan'])) {
                $bulan = (int) $item['bulan'];
                $pengembalian[$bulan] = (int) $item['jumlah'];
            }
        }

        // Reset array ke 0-based index




        $data = [
            'breadcrumb' => "DASHBOARD",
            'js' => 'dashboard.js',
            'count_anggota' => $this->anggota->countAnggota(),
            'count_book' => $this->book->countBook(),
            'count_pinjam' => $this->pinjam->countPinjam(),
            'count_kembali' => $this->kembali->countKembali(),
            'count_rak' => $this->rak->countRak(),
            'count_stok' => $this->book->countStok(),
            'count_kategori' => $this->kategori->countKategori(),
            'tahun' => $tahun,
            'peminjaman' => array_values($peminjaman),   // convert ke 0-based index
            'pengembalian' => array_values($pengembalian),

            // 'grafik' => array_values($grafik),
            'jumlah_anggota_baru' => $this->anggota->getJumlahAnggotaBaruHariIni(),
            'laporan_pinjam' => $this->pinjam->getJumlahPeminjamHariIni(),
            'laporan_kembali' => $this->kembali->getJumlahPengembalianHariIni(),
            'jumlah_peminjam_jatuh_tempo' => $this->pinjam->getJumlahPeminjamJatuhTempoHariIni(),
            'profil' => $this->profil->getAll()
        ];

        //var_dump($this->pinjam->getJumlahPeminjamHariIni());
        $this->viewAdmin('index', $data);
    }
    public function validasiJenisPinjam()
    {
        $JPinjam = $this->input->post('jenisPinjam');
        $type = $this->input->post('jns');

        if ($type == 'Peminjaman') {
            if ($JPinjam == '0') {
                redirect('Peminjaman/individu');
            }
            if ($JPinjam == '1') {
                redirect('Peminjaman/kelompok');
            }
        }

        if ($type == 'Pengembalian') {
            if ($JPinjam == '0') {
                redirect('Pengembalian/individu');
            }
            if ($JPinjam == '1') {
                redirect('Pengembalian/kelompok');
            }
        }
    }
}
