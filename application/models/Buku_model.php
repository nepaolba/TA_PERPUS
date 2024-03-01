<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
   public $kd_buku = "kd_buku";
   public $tabel = "buku";

   public function getAll()
   {
      $this->db->select($this->tabel . '.*, kategori.kategori, rak.nama_rak');
      $this->db->from($this->tabel);
      // $this->db->join('peminjaman', 'peminjaman.kd_buku = ' . $this->tabel . '.kd_buku', 'left');
      $this->db->join('kategori', 'kategori.kd_kategori = ' . $this->tabel . '.kd_kategori');
      $this->db->join('rak', 'rak.id_rak = ' . $this->tabel . '.id_rak');
      $this->db->group_by($this->tabel . '.kd_buku');
      return $this->db->get()->result_array();
   }

   public function getAllBuku()
   {
      $this->db->select($this->tabel . '.*, kategori.kategori, rak.nama_rak');
      $this->db->from($this->tabel);
      $this->db->join('kategori', 'kategori.kd_kategori = ' . $this->tabel . '.kd_kategori');
      $this->db->join('rak', 'rak.id_rak = ' . $this->tabel . '.id_rak');
      $this->db->group_by($this->tabel . '.kd_buku');
      return $this->db->get()->result_array();
   }







   public function getOne($id)
   {
      return $this->db->get_where($this->tabel, [$this->kd_buku => $id])->row_array();
   }

   public function add($data)
   {
      $this->db->insert($this->tabel, $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function update($data, $id)
   {
      $this->db->set($data);
      $this->db->where($this->kd_buku, $id);
      $this->db->update($this->tabel);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function delete($id)
   {
      $this->db->delete($this->tabel, [$this->kd_buku => $id]);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function countBook()
   {
      return $this->db->count_all($this->tabel);
   }

   public function countStok()
   {
      $this->db->select('SUM(jumlah_buku) as total_stok');
      $this->db->from('buku');
      $query = $this->db->get();
      $result = $query->row();
      return $result->total_stok;
   }

   public function getCategoory($code_category)
   {
      $this->db->where('kd_kategori', $code_category);
      return $this->db->get($this->tabel)->result();
   }

   public function getBookDetails($code_book)
   {
      $this->db->select($this->tabel . '.*, kategori.*, rak.*');
      $this->db->from($this->tabel);
      // $this->db->join('peminjaman', 'peminjaman.kd_buku = ' . $this->tabel . '.kd_buku', 'left');
      $this->db->join('kategori', 'kategori.kd_kategori = ' . $this->tabel . '.kd_kategori');
      $this->db->join('rak', 'rak.id_rak = ' . $this->tabel . '.id_rak');
      $this->db->where($this->tabel . '.' . $this->kd_buku, $code_book);
      // $this->db->where($this->tabel . '.' . $this->kd, $code_book);
      $this->db->group_by($this->tabel . '.kd_buku');
      return $this->db->get()->row_array();
   }
}

/* End of file Book_model.php */
