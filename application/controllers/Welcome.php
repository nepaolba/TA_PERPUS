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
      $newbook =  $this->db
         ->select('buku.*, kategori.kategori') // ambil semua kolom dari buku dan nama kategori
         ->from('buku')
         ->join('kategori', 'kategori.kd_kategori = buku.kd_kategori')
         ->order_by('kd_buku', 'DESC')
         ->limit(5)
         ->get()
         ->result();
      $data =  [
         'profil' => $this->profil->getAll(),
         'slide' => $this->profil->slideGetAll(),
         'newbook' => $newbook
      ];
      // $this->load->view('user/layout/header');
      $this->load->view('user/index', $data);
      // $this->load->view('user/layout/footer');
   }
   public function koleksi()
   {
      checkLogin('user');

      $keyword = $this->input->get('keyword');
      if ($keyword) {
         $buku = $this->search($keyword);
      } else {
         $buku = $this->buku->getAll();
      }

      $data =  [
         'profil' => $this->profil->getAll(),
         'data_buku' =>  $buku,
      ];
      $this->load->view('user/layout/header');
      $this->load->view('user/koleksi', $data);
      $this->load->view('user/layout/footer');
   }

   public function search($keyword)
   {
      $this->db->like('judul_buku', $keyword);
      $this->db->or_like('penulis', $keyword);
      $this->db->or_like('penerbit', $keyword);
      return $this->db->get('buku')->result_array();
   }

   public function detailkoleksi($bookCode)
   {
      checkLogin('user');
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
      checkLogin('user');

      $anggota = $this->anggota->getById($this->session->userdata('id'));
      $data =  [
         'profil' => $this->profil->getAll(),
         'anggota' => $anggota,
      ];

      $this->load->view('user/layout/header');
      $this->load->view('user/kartuanggota', $data);
      $this->load->view('user/layout/footer');
   }

   public function daftarPinjam()
   {
      checkLogin('user');
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
      checkLogin('user');
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
      checkLogin('user');
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
         'transaksi' => $peminjaman,
      ];
      $this->load->view('user/layout/header');
      $this->load->view('user/bukti', $data);
      $this->load->view('user/layout/footer');
   }
   public function profil()
   {
      checkLogin('user');
      $kdAnggota = $this->session->userdata('id');
      $this->form_validation->set_rules('nama_anggota', 'Nama', 'trim|required');
      $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
      $this->form_validation->set_rules('nohp', 'Nomor HP', 'trim|required|min_length[11]');

      $data = ['data' => $this->anggota->getById($kdAnggota)];

      if ($this->form_validation->run() == FALSE) {
         $this->load->view('user/layout/header');
         $this->load->view('user/profil', $data);
         $this->load->view('user/layout/footer');
      } else {
         $array = $this->input->post();
         // $marge = $array + ['password' => password_hash($array['kd_anggota'], PASSWORD_DEFAULT)];
         $update = $this->db->set($array)->where('kd_anggota', $kdAnggota)->update('anggota');
         if ($update) {
            $this->session->set_flashdata(['msg' => "Data Berhasil Diubah", "class" => "success"]);
            redirect('Welcome/profil');
         } else {
            $this->session->set_flashdata(['msg' => "Data Gagal Diubah", "class" => "error"]);
            redirect('Welcome/profil');
         }
      }
   }
}


/* End of file Welcome.php */
