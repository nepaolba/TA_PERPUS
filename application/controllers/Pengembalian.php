<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
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

   public function pengajuan()
   {
      $data = ['breadcrumb' => "PENGEMBALIAN BUKU", 'pengembalian' => '', 'js' => 'pengembalian.js'];
      $this->viewAdmin('pengembalian/pengembalian', $data);
   }

   public function ambilSemuaDataAnggota($jenisPinjam)
   {
      $dataAnggota =  $this->kembali->ambilDataAnggota($jenisPinjam);
      $dataAnggotaFiltered = array_map(function ($anggota) {
         return [
            "kd_anggota" => $anggota["kd_anggota"],
            "nama_anggota" => $anggota["nama_anggota"]
         ];
      }, $dataAnggota);
      echo json_encode($dataAnggotaFiltered);
   }

   public function detailPeminjamanAnggota($kdAnggota, $jenisPinjam)
   {
      $detailAnggota = $this->kembali->detailPeminjamanAnggota($kdAnggota, $jenisPinjam);
      unset($detailAnggota['password']);
      echo json_encode($detailAnggota);
   }
   public function submitPengembalian()
   {
      $data = [
         "kd_buku" => $this->input->post('kd_buku'),
         "kd_anggota" => $this->input->post('kd_anggota'),
         "kd_petugas" => $this->input->post('kd_petugas'),
         "jumlah_kembali" => $this->input->post('jumlah_pinjam'),
         "tgl" => date("Y-m-d H:i:s"),
         "denda" => "2000",
         "id_pinjam" => $this->input->post('id_pinjam'),
      ];

      $insert = $this->kembali->add($data);

      if ($insert) {
         $ambilDataBuku = $this->book->getOne($this->input->post('kd_buku'));
         // $ambilDataPeminjam = $this->peminjaman->getOne($this->input->post('id_pinjam'));
         $sisa_stok = (int) $ambilDataBuku['sisa_stok'] + (int) $this->input->post('jumlah_pinjam');
         $jumlah_dipinjam = (int) $ambilDataBuku['jumlah_dipinjam'] - (int) $this->input->post('jumlah_pinjam');
         $this->book->update(['sisa_stok' => $sisa_stok, "jumlah_dipinjam" => $jumlah_dipinjam], $this->input->post('kd_buku'));
         $this->kembali->update("peminjaman", ["status" => 1], $this->input->post('id_pinjam'), "id_pinjam");
         return true;
      } else {
         return false;
      }
   }
   // public function getAjaxWhere(...$var)
   // {
   //    // var_dump($var);
   //    $detailData = $this->kembali->getDetail($var[0], $var[1]);
   //    echo json_encode($detailData);
   // }
}
