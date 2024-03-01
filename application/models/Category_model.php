<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Category_model extends CI_Model
{
   public $table = "kategori";
   public $primary = "kd_kategori";

   public function getAll()
   {
      return $this->db->get($this->table)->result_array();
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

   public function countKategori()
   {
      return $this->db->count_all('kategori');
   }
}

/* End of file kategori_model.php */
