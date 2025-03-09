<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin('admin');
        $this->load->model('Peminjaman_model', 'peminjaman');
        $this->load->model('Pengembalian_model', 'kembali');
        // $this->load->model('Anggota_model', 'anggota');
        // $this->load->model('Buku_model', 'buku');
        $this->load->helper('text');
        // $this->load->helper('notif_helper');
    }

    public function laporan_pengembalian()
    {

        $data = [
            'breadcrumb' => "Laporan Pengembalian",
            'pengembalian' =>  $this->kembali->getAll(),
            'js' => 'laporan.js'
        ];

        $this->viewAdmin('laporan/pengembalian', $data);
    }

    public function laporan_peminjaman()
    {
        $data = [
            'breadcrumb' => "Laporan Peminjaman",
            'peminjaman' => $this->peminjaman->getAll(),
            'js' => 'laporan.js'
        ];

        $this->viewAdmin('laporan/peminjaman', $data);
    }
}

/* End of file Laporan.php */
