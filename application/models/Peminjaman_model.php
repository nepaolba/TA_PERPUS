<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_model extends CI_Model
{

   public function getAll()
   {
      $query = $this->db->select('*')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->join('anggota', 'anggota.kd_anggota = peminjaman.nis_nip')
         ->join('rak', 'rak.id_rak = buku.id_rak')
         ->join('kategori', 'kategori.kd_kategori = buku.kd_kategori')
         ->join('petugas', 'petugas.kd_petugas = peminjaman.kd_petugas')
         ->where('peminjaman.status', 0)
         ->order_by('peminjaman.id_pinjam', 'DESC')
         ->get()->result_array();
      return $query;
   }

   public function countPinjam()
   {
      return $this->db->count_all('peminjaman');
   }

   public function add($data)
   {
      $this->db->insert('peminjaman', $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }
   // private function updateStokBuku($kd_buku, $jumlah_pinjam) {
   //       // Update stok buku menggunakan set
   //       $this->db->set('jumlah_buku', 'jumlah_buku - ' . $jumlah_pinjam, false);
   //       $this->db->where('kode_buku', $kd_buku);
   //       $this->db->update('_buku');
   //   }

   public function delete($id_pinjam)
   {
      // var_dump($id_pinjam);

      $this->db->where('id_pinjam', $id_pinjam)
         ->delete('peminjaman');
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function getCodeBook($code)
   {
      $this->db->select('*')
         ->from('peminjaman')
         ->where('kd_buku', $code);
      return $this->db->get()->result_array();
   }


   public function getPeminjam($kd_buku, $kd_anggota, $jenis_pinjam)
   {
      $this->db->select('*');
      $this->db->from('peminjaman');
      $this->db->where('kd_buku', $kd_buku);
      $this->db->where('nis_nip', $kd_anggota);
      $this->db->where('jenis_pinjam', $jenis_pinjam);
      $this->db->where('status', 0);
      $query = $this->db->get();
      // var_dump($query->result_array());
      if ($query->num_rows() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function joinGetCodeBook($code)
   {
      $this->db->select('peminjaman.*,anggota.kd_anggota, anggota.nama_anggota, SUM(peminjaman.jumlah_pinjam) as total_pinjam')
         ->from('peminjaman')
         ->join('anggota', 'anggota.kd_anggota = peminjaman.nis_nip')
         ->where('kd_buku', $code)
         ->where('status', 0)
         ->group_by('anggota.kd_anggota, anggota.nama_anggota');

      return $this->db->get()->result_array();
   }
   public function joinGetCodeAnggota($code)
   {
      $this->db->select('peminjaman.*, buku.judul_buku, SUM(peminjaman.jumlah_pinjam) as total_pinjam')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->where('nis_nip', $code)
         ->group_by('buku.kd_buku, buku.judul_buku');
      return $this->db->get()->result_array();
   }

   public function getJumlahPeminjamanPerBulan($tahun)
   {
      $this->db->select('MONTH(tgl_pinjam) AS bulan, COUNT(*) AS jumlah_peminjaman');
      $this->db->from('peminjaman');
      $this->db->where('YEAR(tgl_pinjam)', $tahun);
      $this->db->group_by('bulan');
      $this->db->order_by('bulan');
      $query = $this->db->get();
      return $query->result_array();
   }
   public function getJumlahPeminjamHariIni()
   {
      $today = date('Y-m-d');
      $this->db->select('COUNT(id_pinjam) as jumlah_pinjam');
      $this->db->from('peminjaman');
      $this->db->where('tgl_pinjam', $today);
      $query = $this->db->get();
      $result = $query->row();
      return $result->jumlah_pinjam;
   }
   public function getJumlahPeminjamJatuhTempoHariIni()
   {
      $today = date('Y-m-d'); // Ambil tanggal hari ini
      $this->db->select('COUNT(id_pinjam) as jumlah_peminjam_jatuh_tempo');
      $this->db->from('peminjaman');
      $this->db->where('tgl_kembali', $today);
      $query = $this->db->get();
      $result = $query->row();
      return $result->jumlah_peminjam_jatuh_tempo;
   }
   public function getOne($id)
   {
      return $this->db->get_where("peminjaman", ["id_pinjam" => $id])->row_array();
   }
}

/* End of file Peminjaman_model.php */
