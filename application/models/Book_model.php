<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Book_model extends CI_Model
{
   public $table = "buku";
   public $primary = "kd_buku";

   public function getAll()
   {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->join('kategori', 'kategori.kd_kategori = ' . $this->table . '.kd_kategori');
      $this->db->join('rak', 'rak.id_rak = ' . $this->table . '.id_rak');
      return $this->db->get()->result_array();
   }

   public function getOne($id)
   {
      return $this->db->get_where($this->table, [$this->primary => $id])->row_array();
   }

   public function add($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function update($data, $id)
   {
      $this->db->where($this->primary, $id);
      $this->db->update($this->table, $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }


   public function delete($id)
   {
      $this->db->delete($this->table, [$this->primary => $id]);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function countBook()
   {
      return $this->db->count_all($this->table);
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
      return $this->db->get($this->table)->result();
   }

   public function getBookDetails($code_book)
   {
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->join('kategori', 'kategori.kd_kategori = ' . $this->table . '.kd_kategori');
      $this->db->join('rak', 'rak.id_rak = ' . $this->table . '.id_rak');
      $this->db->where($this->primary, $code_book);
      return $this->db->get()->row_array();
   }
}

/* End of file Book_model.php */
