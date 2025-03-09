<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      checkLogin('admin');
      $this->load->model('Peminjaman_model', 'peminjaman');
      $this->load->model('Buku_model', 'book');
      $this->load->model('Anggota_model', 'anggota');
      $this->load->model('Category_model', 'category');
      $this->load->helper('notif_helper');
      $this->load->helper('text');
      $this->load->helper('date');
   }


   public function index()
   {
      // $jumlahBukuDipinjam = $this->hitungJumlahBukuDipinjam($pinjam);
      // $mapBook = $this->buatMapBook();
      // $pinjam = $this->prosesDataPinjam($pinjam, $mapBook, $jumlahBukuDipinjam);
      $pinjam = $this->peminjaman->getAll();
      $data = ['breadcrumb' => "PEMINJAMAN", 'peminjaman' => $pinjam, 'js' => 'peminjaman.js'];
      $this->viewAdmin('peminjaman/index', $data);
   }

   public function add()
   {
      $data = ['breadcrumb' => "Peminjaman Buku", 'category' => $this->category->getAll(), 'anggota' => $this->anggota->getAll(), 'js' => 'peminjaman.js'];
      $this->viewAdmin('peminjaman/add', $data);
   }

   public function cariBuku($idAnggota)
   {
      $data = ['breadcrumb' => "Peminjaman Buku", 'category' => $this->category->getAll(), 'anggota' => $this->anggota->getById($idAnggota), 'js' => 'peminjaman.js'];
      $this->viewAdmin('peminjaman/cariBuku', $data);
   }



   public function submitPinjam()
   {
      $tgl_pinjam = date('Y-m-d H:i:s');
      $jam_kembali =  $this->input->post('waktu');
      $tgl_kembali = $this->input->post('tgl_kembali');
      $jumlah_pinjam = $this->input->post('jumlah_pinjam') ? $this->input->post('jumlah_pinjam') : '1';
      $tgl_kembali ?  $tgl_kembali =  date('Y-m-d', strtotime(str_replace('/', '-', $tgl_kembali))) . " " . date('H:i:s') : "";
      $jam_kembali ? $tgl_kembali = date('Y-m-d') . ' ' . $jam_kembali . ':00' : "";
      // var_dump(date('Y-m-d', strtotime(str_replace('/', '-', $tgl_kembali))) . " " . date('H:i:s'));
      $setArray = [
         'tgl_pinjam' => $tgl_pinjam,
         'kd_petugas' => $this->session->userdata('id'),
         "tgl_kembali" => $tgl_kembali,
         'jumlah_pinjam' => $jumlah_pinjam,
      ];
      $kelas = $this->input->post('kelas');
      ($kelas) ? $setArray['kelas'] = $kelas : $setArray['kelas'] = '-';
      $dataPost = $this->input->post();
      unset($dataPost['waktu']);
      $marge = $setArray + $dataPost;
      $insert =  $this->peminjaman->add($marge);
      if ($insert) {
         // update stok buku
         $ambilDataBuku = $this->book->getOne($this->input->post('kd_buku'));
         $sisa_stok = $ambilDataBuku['sisa_stok'] - $jumlah_pinjam;
         $jumlah_dipinjam = $ambilDataBuku['jumlah_dipinjam'] + $jumlah_pinjam;
         $this->book->update(['sisa_stok' => $sisa_stok, 'jumlah_dipinjam' => $jumlah_dipinjam], $this->input->post('kd_buku'));
         notif('Data Berhasil Disimpan', 'success', 'Peminjaman');
      } else {
         notif('Data Gagal Disimpan', 'error', 'Peminjaman');
      }
   }





   public function delete(...$var)
   {
      // var_dump($var[1]);
      $delete = $this->peminjaman->delete($var[0]);
      if ($delete) {
         $ambilDataBuku = $this->book->getOne($var[1]);
         $sisa_stok = (int) $ambilDataBuku['sisa_stok'] + (int) $var[2];
         $jumlah_dipinjam = (int) $ambilDataBuku['jumlah_dipinjam'] - (int) $var[2];
         $this->book->update(['sisa_stok' => $sisa_stok, "jumlah_dipinjam" => $jumlah_dipinjam], $var[1]);
         notif('Data Berhasil Dihapus', 'success', 'Peminjaman');
      } else {
         notif('Data Gagal Dihapus', 'error', 'Peminjaman');
      }
   }


   public function getAjaxAllKategori()
   {
      echo json_encode($this->category->getAll());
   }

   public function getAjaxPeminjam()
   {
      // $individu = 'individu';
      // $kelompok = 'kelompok';
      $type = $this->input->post('type') == "individu" ? 0 : 1;
      // var_dump($type);
      $kd_buku = $this->input->post('kd_buku');
      $kd_anggota = $this->input->post('kd_anggota');
      // if ($type == "individu") {
      $peminjam = $this->peminjaman->getPeminjam($kd_buku, $kd_anggota, $type);
      if ($peminjam) {
         echo json_encode(false);
      } else {
         echo json_encode(true);
      }
      // } else {
      //    echo json_encode(true);
      // }
   }

   public function getAjaxBook($code_category)
   {
      $bookCategory = $this->book->getCategoory($code_category);

      echo json_encode($bookCategory);
   }

   public function getAjaxAllBook()
   {
      $book = $this->book->getAll();
      echo json_encode($book);
   }
   public function getAjaxAllAnggota()
   {
      $anggota = $this->anggota->getAll();
      echo json_encode($anggota);
   }
   public function getAjaxAllCoba()
   {
      $anggota = $this->book->coba();
      print_r($anggota);
   }
   // public function ketersedian_stok($code_category)
   // {
   //    $bookCategory = $this->book->getCategoory($code_category);
   //    echo json_encode($bookCategory);
   // }

   public function getBookDetails($code_book)
   {
      // $total_pinjam = 0;
      // $jumlah_pinjam = 0;
      $gabung = $this->book->getBookDetails($code_book);
      // $pinjam = $this->peminjaman->getCodeBook($code_book);
      // $sisa_stok = $book['jumlah_buku'];
      // if ($pinjam) {
      //    foreach ($pinjam as  $value) {
      //       $total_pinjam += (int) $value['jumlah_pinjam'];
      //    }
      //    $jumlah_pinjam = $total_pinjam;
      //    $sisa_stok = (int)$book['jumlah_buku']  - $total_pinjam;
      // }
      // $data = ['jumlah_pinjam' => $jumlah_pinjam, "sisa_stok" => $sisa_stok];
      // $gabung = $book + $data;
      echo json_encode($gabung);
   }




   // public function hitungJumlahBukuDipinjam($pinjam)
   // {
   //    $jumlahBukuDipinjam = [];
   //    foreach ($pinjam as $pinjamItem) {
   //       $kdBuku = $pinjamItem['kd_buku'];
   //       $jumlahPinjam = (int) $pinjamItem['jumlah_pinjam'];
   //       $jumlahBukuDipinjam[$kdBuku] = ($jumlahBukuDipinjam[$kdBuku] ?? 0) + $jumlahPinjam;
   //    }
   //    return $jumlahBukuDipinjam;
   // }

   // public function buatMapBook()
   // {
   //    $book = $this->book->getAll();
   //    return array_column($book, null, 'kd_buku');
   // }

   // public function prosesDataPinjam($pinjam, $mapBook, $jumlahBukuDipinjam)
   // {
   //    foreach ($pinjam as &$val) {
   //       $kdBuku = $val['kd_buku'];
   //       (isset($mapBook[$kdBuku])) ? $val['jumlah_buku'] -= $jumlahBukuDipinjam[$kdBuku] : "";
   //    }
   //    unset($val);
   //    return $pinjam;
   // }
}

/* End of file Peminjaman.php */
