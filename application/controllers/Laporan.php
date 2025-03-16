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
        $this->load->helper('text');
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


    public function filter_pengembalian()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start = $this->input->post('start'); // Offset untuk pagination
        $length = $this->input->post('length'); // Jumlah data per halaman
        $draw = $this->input->post('draw'); // Untuk keperluan pengulangan permintaan
        $this->db->select('*');
        $this->db->from('pengembalian');
        $this->db->join('peminjaman', 'peminjaman.id_pinjam = pengembalian.id_pinjam');
        $this->db->join('buku', 'buku.kd_buku = peminjaman.kd_buku');
        $this->db->join('anggota', 'anggota.kd_anggota = peminjaman.nis_nip');
        $total_records =  $this->db->count_all_results();
        $this->db->select('*');
        $this->db->from('pengembalian');
        $this->db->join('peminjaman', 'peminjaman.id_pinjam = pengembalian.id_pinjam');
        $this->db->join('buku', 'buku.kd_buku = peminjaman.kd_buku');
        $this->db->join('rak', 'rak.id_rak = buku.id_rak');
        $this->db->join('kategori', 'kategori.kd_kategori = buku.kd_kategori');
        $this->db->join('petugas', 'petugas.kd_petugas = pengembalian.kd_petugas');
        $this->db->join('anggota', 'anggota.kd_anggota = peminjaman.nis_nip');
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('tgl >=', $start_date);
            $this->db->where('tgl <=', $end_date);
        }
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $data = $query->result_array();
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('tgl >=', $start_date);
            $this->db->where('tgl <=', $end_date);
        }
        $filtered_records = $this->db->count_all_results('pengembalian');
        echo json_encode([
            "draw" => intval($draw),
            "recordsTotal" => $total_records, // Jumlah data tanpa filter
            "recordsFiltered" => $filtered_records, // Jumlah data setelah filter
            "data" => $data // Data pengembalian yang sesuai filter
        ]);
    }

    public function filter()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start = $this->input->post('start'); // Offset data untuk pagination
        $length = $this->input->post('length'); // Jumlah data per halaman
        $draw = $this->input->post('draw'); // Untuk keperluan pengulangan permintaan
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'peminjaman.nis_nip = anggota.kd_anggota');
        $this->db->join('buku', 'peminjaman.kd_buku = buku.kd_buku');
        $total_records = $this->db->count_all_results();
        $this->db->select('peminjaman.*, anggota.nama_anggota, buku.judul_buku');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'peminjaman.nis_nip = anggota.kd_anggota');
        $this->db->join('buku', 'peminjaman.kd_buku = buku.kd_buku');
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('tgl_pinjam >=', $start_date);
            $this->db->where('tgl_pinjam <=', $end_date);
        }
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $data = $query->result_array();
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('tgl_pinjam >=', $start_date);
            $this->db->where('tgl_pinjam <=', $end_date);
        }
        $filtered_records = $this->db->count_all_results('peminjaman');
        echo json_encode([
            "draw" => intval($draw), // Untuk memastikan permintaan yang konsisten
            "recordsTotal" => $total_records, // Total data tanpa filter
            "recordsFiltered" => $filtered_records, // Total data setelah filter
            "data" => $data // Data untuk tabel
        ]);
    }
}

/* End of file Laporan.php */
