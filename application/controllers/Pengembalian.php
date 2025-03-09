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

   public function individu()
   {
      $dataPeminjam = $this->db->select('*')
         ->from('peminjaman')
         ->join('anggota', 'anggota.kd_anggota=peminjaman.nis_nip')
         ->join('buku', 'buku.kd_buku=peminjaman.kd_buku')
         ->where('status !=', 1)
         ->where('jenis_pinjam', 0)
         ->group_by('anggota.kd_anggota')
         ->get()
         ->result();
      $data = [
         'breadcrumb' => "PENGEMBALIAN INDIVIDU",
         'peminjaman' => $dataPeminjam,
         'js' => 'pengembalian_individu.js'
      ];
      $this->viewAdmin('pengembalian/pengembalian_individu', $data);
   }


   public function daftarBuku()
   {

      $kdAnggota = $this->input->post('kd_anggota');
      $dataBuku = $this->db->select('*')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku=peminjaman.kd_buku', 'left')
         ->join('rak', 'buku.id_rak=rak.id_rak', 'left')
         ->join('kategori', 'buku.kd_kategori=kategori.kd_kategori', 'left')
         ->where('peminjaman.status !=', 1)
         ->where('jenis_pinjam', 0)
         ->where('nis_nip', $kdAnggota)
         ->get()->result();
      $dataAnggota = $this->db->select('kd_anggota,alamat,jk,nama_anggota,nohp,status_anggota,tgl_daftar_anggota')
         ->from('anggota')
         ->where('kd_anggota', $kdAnggota)
         ->get()->row();
      $data = [
         'breadcrumb' => "PENGEMBALIAN INDIVIDU",
         'dataBuku' => $dataBuku,
         'dataAnggota' => $dataAnggota,
         'js' => 'pengembalian_individu.js'
      ];
      $this->viewAdmin('pengembalian/daftarBukuIndividu', $data);
   }



   public function submitPengembalian($idPinjam, $kd_buku)
   {
      $data = [
         "kd_petugas" => $this->session->userdata('id'),
         "jumlah_kembali" => 1,
         "tgl" => date("Y-m-d H:i:s"),
         "denda" => "0",
         "id_pinjam" => $idPinjam,
      ];
      // var_dump($data);


      $insert = $this->kembali->add($data);

      if ($insert) {
         $ambilDataBuku = $this->book->getOne($kd_buku);
         $sisa_stok = (int) $ambilDataBuku['sisa_stok'] + 1;
         $jumlah_dipinjam = (int) $ambilDataBuku['jumlah_dipinjam'] - 1;
         $this->book->update(['sisa_stok' => $sisa_stok, "jumlah_dipinjam" => $jumlah_dipinjam], $kd_buku);
         $this->kembali->update("peminjaman", ["status" => 1], $idPinjam, "id_pinjam");
         notif('Data Berhasil Disimpan', 'success', 'Pengembalian');
      } else {
         notif('Data Berhasil Disimpan', 'error', 'Pengembalian');
      }
   }
}
