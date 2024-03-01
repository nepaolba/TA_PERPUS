<?php

class CURD_model extends CI_Model
{
   public function create($table, $data)
   {
      $this->db->insert($table, $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function update($table, $data, $attrPrimary, $id)
   {
      $this->db->where($attrPrimary, $id);
      $this->db->update($table, $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function delete($table, $attrPrimary, $id)
   {
      $this->db->where($attrPrimary, $id);
      $this->db->delete($table);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function read($table)
   {
      return $this->db->get($table)->result_array();
   }
}
