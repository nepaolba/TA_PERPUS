<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      checkLogin('admin');
      $this->load->model('Pengembalian_model', 'kembali');
      $this->load->model('Peminjaman_model', 'peminjaman');
      $this->load->model('Anggota_model', 'anggota');
      $this->load->model('Buku_model', 'book');
      $this->load->helper('notif_helper');
      $this->load->helper('text');
      $this->load->helper('date');
   }

   public function index()
   {
      $pengembalian = $this->kembali->getAll();
      $data = ['breadcrumb' => "PENGEMBALIAN", 'pengembalian' => $pengembalian, 'js' => 'indexpengembalian.js'];
      $this->viewAdmin('pengembalian/index', $data);
   }

   public function pengembalian()
   {
      $data = [
         'breadcrumb' => "PENGEMBALIAN",
         'js' => 'pengembalian_individu.js'
      ];
      $this->viewAdmin('pengembalian/pengembalian_individu', $data);
   }


   public function daftarBuku()
   {
      $idpinjam = $this->input->post('idpinjam');
      $peminjaman = $this->db->get_where('peminjaman', ['id_pinjam' => $idpinjam])->row();
      if ($peminjaman) {
         $this->db->select('*')
            ->from('peminjaman')
            ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
            ->join('rak', 'rak.id_rak = buku.id_rak')
            ->join('kategori', 'kategori.kd_kategori = buku.kd_kategori')
            ->join('anggota AS anggota1', 'anggota1.kd_anggota = peminjaman.pj1');
         if ((int)$peminjaman->jenis_pinjam === 1) {
            $this->db->join('anggota AS anggota2', 'anggota2.kd_anggota = peminjaman.pj2');
         }
         $this->db->where('peminjaman.id_pinjam', $idpinjam);
         $dataBuku = $this->db->get()->row();

         if ($dataBuku->status == 'dikembalikan') {
            redirect('Pengembalian/pengembalian');
         }
      } else {
         show_error('Data peminjaman tidak ditemukan.', 404);
         return;
      }
      $data = [
         'breadcrumb' => "PENGEMBALIAN",
         'datapinjam' => $dataBuku,
         'js' => 'pengembalian_individu.js'
      ];
      $this->viewAdmin('pengembalian/daftarBukuIndividu', $data);
   }

   public function submitPengembalian($idPinjam, $kd_buku)
   {

      $peminjaman = $this->db->get_where('peminjaman', ['id_pinjam' => $idPinjam])->row();
      $jumlahKembali = $peminjaman->jumlah_pinjam;
      if (!$peminjaman) {
         notif('Data peminjaman tidak ditemukan.', 'error', 'Pengembalian');
         return;
      }
      $data = [
         "kd_petugas" => $this->session->userdata('id'),
         "jumlah_kembali" =>  $jumlahKembali,
         "tgl" => date("Y-m-d H:i:s"),
         "denda" => "0",
         "id_pinjam" => $idPinjam,
      ];
      $insert = $this->kembali->add($data);

      if ($insert) {
         $ambilDataBuku = $this->book->getOne($kd_buku);

         $sisa_stok       = (int) $ambilDataBuku['sisa_stok'] + $jumlahKembali;
         $jumlah_dipinjam = (int) $ambilDataBuku['jumlah_dipinjam'] - $jumlahKembali;

         $this->db->where('kd_buku', $kd_buku)
            ->update('buku', [
               'sisa_stok'       => $sisa_stok,
               'jumlah_dipinjam' => $jumlah_dipinjam
            ]);

         if ($jumlahKembali >= $peminjaman->jumlah_pinjam) {
            $this->db->where('id_pinjam', $idPinjam)
               ->update('peminjaman', ['status' => 'dikembalikan']);
         }

         notif('Data Berhasil Disimpan', 'success', 'Pengembalian');
      } else {
         notif('Data Berhasil Disimpan', 'error', 'Pengembalian');
      }
   }
}
