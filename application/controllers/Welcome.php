<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      checkLogin('user');
      $this->load->model('Profil_model', 'profil');
      $this->load->model('Buku_model', 'buku');
      $this->load->model('Anggota_model', 'anggota');
   }

   public function index()
   {
      $data =  [
         'profil' => $this->profil->getAll(),
         'slide' => $this->profil->slideGetAll(),

      ];
      $this->load->view('user/layout/header');
      $this->load->view('user/index', $data);
      $this->load->view('user/layout/footer');
   }
   public function koleksi()
   {
      $data =  [
         'profil' => $this->profil->getAll(),
         'data_buku' =>  $this->buku->getAll(),
      ];
      $this->load->view('user/layout/header');
      $this->load->view('user/koleksi', $data);
      $this->load->view('user/layout/footer');
   }
   public function detailkoleksi($bookCode)
   {
      $bukuJoinKategori = $this->db->select("*")
         ->from('buku')
         ->join('kategori', 'buku.kd_kategori = kategori.kd_kategori')
         ->where('buku.kd_buku', $bookCode)
         ->get()->row();

      $rekomendasibuku = $this->db->select("*")
         ->from('buku')
         ->join('kategori', 'buku.kd_kategori = kategori.kd_kategori')
         ->where('buku.penulis',  $bukuJoinKategori->penulis)
         ->get()->result();

      $data =  [
         'profil' => $this->profil->getAll(),
         'buku' => $bukuJoinKategori,
         'rekomendasibuku' => $rekomendasibuku
      ];

      $this->load->view('user/layout/header');
      $this->load->view('user/detailkoleksi', $data);
      $this->load->view('user/layout/footer');
   }
   public function kartuAnggota()
   {
      // $bukuJoinKategori = $this->db->select("*")
      //    ->from('buku')
      //    ->join('kategori', 'buku.kd_kategori = kategori.kd_kategori')
      //    ->where('buku.kd_buku', $bookCode)
      //    ->get()->row();

      // $rekomendasibuku = $this->db->select("*")
      //    ->from('buku')
      //    ->join('kategori', 'buku.kd_kategori = kategori.kd_kategori')
      //    ->where('buku.penulis',  $bukuJoinKategori->penulis)
      //    ->get()->result();
      $anggota = $this->anggota->getById($this->session->userdata('id'));
      // var_dump($anggota);

      $data =  [
         'profil' => $this->profil->getAll(),
         'anggota' => $anggota,
         // 'rekomendasibuku' => $rekomendasibuku
      ];

      $this->load->view('user/layout/header');
      $this->load->view('user/kartuanggota', $data);
      $this->load->view('user/layout/footer');
   }
}


/* End of file Welcome.php */
