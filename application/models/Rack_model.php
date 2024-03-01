<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Rack_model extends CI_Model
{
   public $table = "rak";
   public $primary = "id_rak";

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

   public function countRak()
   {
      return $this->db->count_all('rak');
   }
}

/* End of file rak_model.php */
