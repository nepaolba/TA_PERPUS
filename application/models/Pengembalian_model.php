<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian_model extends CI_Model
{

   public function getAll()
   {
      $query = $this->db->select('*')
         ->from('pengembalian')
         ->join('buku', 'buku.kd_buku = pengembalian.kd_buku')
         ->join('rak', 'rak.id_rak = buku.id_rak')
         ->join('kategori', 'kategori.kd_kategori = buku.kd_kategori')
         ->join('petugas', 'petugas.kd_petugas = pengembalian.kd_petugas')
         ->join('anggota', 'anggota.kd_anggota = pengembalian.kd_anggota')
         ->join('peminjaman', 'peminjaman.id_pinjam = pengembalian.id_pinjam')
         // ->group_by('pengembalian.id_kembali')
         ->get()->result_array();
      return $query;
   }

   public function ambilDataAnggota($jenisPinjam)
   {
      $query = $this->db->select('*')
         ->from('anggota a')
         ->join('peminjaman', 'peminjaman.nis_nip = a.kd_anggota')
         ->where('peminjaman.status', 0)
         ->where('peminjaman.jenis_pinjam', $jenisPinjam)
         ->group_by('a.kd_anggota')
         ->get()->result_array();
      return $query;
   }
   public function getKategori()
   {
      return  $this->db->get('kategori')->result_array();
   }
   public function detailPeminjamanAnggota($kd_anggota, $jenisPinjam)
   {
      $query = $this->db->select('*')
         ->from('anggota a')
         ->join('peminjaman p', 'p.nis_nip = a.kd_anggota')
         ->join('buku b', 'b.kd_buku = p.kd_buku')
         ->join('rak r', 'r.id_rak = b.id_rak')
         ->join('kategori k', 'k.kd_kategori = b.kd_kategori')
         ->where('p.status', 0)
         ->where('p.jenis_pinjam', $jenisPinjam)
         ->where('a.kd_anggota', $kd_anggota)
         ->group_by('a.kd_anggota')
         ->get()->row_array();
      return $query;
   }
   public function add($data)
   {
      $this->db->insert('pengembalian', $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }
   public function update($tabel = "pengembalian", $data, $id, $where)
   {
      $this->db->set($data);
      $this->db->where($where, $id);
      $this->db->update($tabel);
      return $this->db->affected_rows() > 0 ? true : false;
   }
}
