<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      checkLogin('admin');
      $this->load->model('Peminjaman_model', 'peminjaman');
      $this->load->model('Category_model', 'kategori');
      $this->load->model('Buku_model', 'buku');
      $this->load->model('Rack_model', 'rack');
      $this->load->helper('notif_helper');
      $this->load->helper('text');
   }

   public function index()
   {
      $data = ['breadcrumb' => "DATA BUKU", 'data_buku' =>  $this->buku->getAll(), 'js' => 'buku.js'];

      $this->viewAdmin('buku/index', $data);
   }




   public function tambahBuku()
   {
      $data = ['breadcrumb' => "TAMBAH BUKU", 'category' => $this->kategori->getAll(), 'rack' => $this->rack->getAll(), 'js' => 'buku.js'];
      $this->viewAdmin('buku/tambahBuku', $data);
   }

   public function simpanDataBuku()
   {
      $imgDefault = "default.jpg";
      $uploadedImage = $this->checkImage('foto');
      ($uploadedImage) ? $uploadedImageName = $uploadedImage : $uploadedImageName = $imgDefault;
      $dataPost = $this->input->post();
      $margedDataPostImage = $dataPost + ['foto' => $uploadedImageName, 'sisa_stok' => $this->input->post('jumlah_buku')];
      $insert = $this->buku->add($margedDataPostImage);
      ($insert) ? notif('Data Berhasil Disimpan', 'success', 'Buku') : notif('Data Gagal Disimpan', 'error', 'Buku');
   }

   public function update($bookCode)
   {
      $data_buku = $this->buku->getOne($bookCode);
      $kategori = $this->kategori->getAll();
      $rak_buku = $this->rack->getAll();
      $data = ['breadcrumb' => "UBAH DATA BUKU", 'category' => $kategori, 'bookData' => $data_buku, 'rack' => $rak_buku, 'js' => 'buku.js'];
      $this->viewAdmin('buku/update', $data);
   }

   public function simpanUbahDataBuku($bookCode)
   {
      $data_buku = $this->buku->getOne($bookCode);
      $new_image =  $this->checkImage('foto');
      $dataPost =  $this->input->post();
      ($new_image) ? $dataPost['foto'] = $new_image : '';
      $update = $this->buku->update($dataPost, $bookCode);
      if ($update) {
         ($new_image && $data_buku['foto'] != 'default.jpg') ? unlink(FCPATH . './assets/dist/img/buku/' . $data_buku['foto']) : "";
         notif('Data Berhasil Diubah', 'success', 'Buku');
      } else {
         notif('Data Gagal Diubah', 'error', 'Buku');
      }
   }

   public function detail($kd_buku)
   {
      $queryPeminjaman = $this->db->select('anggota.kd_anggota, anggota.nama_anggota, peminjaman.jumlah_pinjam, peminjaman.tgl_kembali')
         ->from('buku')
         ->join('peminjaman', 'buku.kd_buku=peminjaman.kd_buku')
         ->join('anggota', 'peminjaman.nis_nip=anggota.kd_anggota')
         ->where('buku.kd_buku', $kd_buku)
         ->get()->result();
      $queryDetailBuku = $this->db->select('*')
         ->from('buku')
         ->join('rak', 'buku.id_rak=rak.id_rak')
         ->join('kategori', 'kategori.kd_kategori=buku.kd_kategori')
         ->where('buku.kd_buku', $kd_buku)
         ->get()->row();



      $totalPeminjaman = count($queryPeminjaman);
      $data = ['breadcrumb' => "DETAIL BUKU", 'book' => $queryDetailBuku, 'peminjam' => $queryPeminjaman, 'total_pinjam' => $totalPeminjaman, 'js' => 'buku.js'];
      $this->viewAdmin('buku/detail', $data);
   }

   public function checkImage($name)
   {
      $upload_image = $_FILES[$name]['name'];
      if ($upload_image) {
         $config['upload_path'] = './assets/dist/img/buku/';
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size']  = '2000';
         $this->load->library('upload', $config);
         if ($this->upload->do_upload($name)) {
            return $this->upload->data('file_name');
         } else {
            notif($this->upload->display_errors(), 'error', 'Buku');
         }
      } else {
         return false;
      }
   }

   public function delete($bookCode)
   {
      $bookData = $this->buku->getOne($bookCode);
      $deleteStatus = $this->buku->delete($bookCode);
      if ($deleteStatus) {
         $photo = $bookData['foto'];
         ($photo != 'default.png' && file_exists(FCPATH . '/assets/dist/img/buku/' . $photo)) ? unlink(FCPATH . '/assets/dist/img/buku/' . $bookData['foto']) : "";
         notif('Data Berhasil Dihapus', 'success', 'Buku');
      } else {
         notif('Data Gagal Dihapus', 'error', 'Buku');
      }
   }

   public function cariBuku()
   {
      $keyword = $this->input->post('keyword');
      $hasilCari = $this->buku->cariBuku($keyword);
      echo json_encode($hasilCari);
   }

   public function getby_buku_id($id_buku)
   {

      $hasil = $this->buku->getOne($id_buku);
      echo json_encode($hasil);
   }
}

/* End of file Buku.php */
