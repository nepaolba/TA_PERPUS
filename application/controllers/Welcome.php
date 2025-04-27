<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      // checkLogin('user');
      $this->load->model('Profil_model', 'profil');
      $this->load->model('Buku_model', 'buku');
      $this->load->model('Anggota_model', 'anggota');
      $this->load->helper('text');
      $this->load->helper('notif_helper');
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

   public function daftarPinjam()
   {
      $peminjaman = $this->db
         ->select('peminjaman.*, buku.kd_buku, buku.judul_buku, buku.penulis')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->where('pj1', $this->session->userdata('id'))
         ->where('jenis_pinjam', '0')
         ->where_not_in('status', ['dikembalikan'])
         ->get()
         ->result();
      $data =  [
         'profil' => $this->profil->getAll(),
         'pinjam' => $peminjaman,
      ];
      $this->load->view('user/layout/header');
      $this->load->view('user/daftarPinjam', $data);
      $this->load->view('user/layout/footer');
   }

   public function hapusPeminjaman($id_peminjaman)
   {
      $pinjam = $this->db->where('id_pinjam', $id_peminjaman)->get('peminjaman')->row();
      $hapus = $this->db->where('id_pinjam', $id_peminjaman)->delete('peminjaman');
      if ($hapus) {
         $this->updateJumlahPeminjaman($pinjam->kd_buku, $pinjam->jumlah_pinjam);
         $this->updateStokPeminjaman($pinjam->kd_buku, $pinjam->jumlah_pinjam);
         notif('Berhasil dihapus.', 'success', 'Welcome/daftarPinjam');
      } else {
         notif('Gagal dihapus.', 'error', 'Welcome/daftarPinjam');
      }
   }



   public function updateStokPeminjaman($kd_buku, $jumlahPinjam)
   {
      $this->db->set('sisa_stok', 'sisa_stok + ' . (int)$jumlahPinjam, FALSE)
         ->where('kd_buku', $kd_buku)
         ->update('buku');
   }

   public function updateJumlahPeminjaman($kd_buku, $jumlahPinjam)
   {
      $this->db->set('jumlah_dipinjam', 'jumlah_dipinjam - ' . (int)$jumlahPinjam, FALSE)
         ->where('kd_buku', $kd_buku)
         ->update('buku');
   }

   public function bukti($id_peminjaman)
   {
      $peminjaman = $this->db
         ->select('peminjaman.*, 
                buku.kd_buku, buku.judul_buku, buku.penulis, 
                anggota.nama_anggota, anggota.jenis_anggota')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->join('anggota', 'anggota.kd_anggota = peminjaman.pj1')
         ->where('id_pinjam', $id_peminjaman)
         ->get()
         ->row();

      $data =  [
         // 'profil' => $this->profil->getAll(),
         'transaksi' => $peminjaman,
      ];
      $this->load->view('user/layout/header');
      $this->load->view('user/bukti', $data);
      $this->load->view('user/layout/footer');
   }
}


/* End of file Welcome.php */
