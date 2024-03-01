<?php

class Petugas_model extends CI_Model
{
   private $table = 'petugas';
   private $primary = 'kd_petugas';
   function getAll()
   {
      return $this->db->get($this->table)->result();
   }
   function getById($id)
   {
      return $this->db->get_where($this->table, [$this->primary => $id])->row();
   }
   public function add($data)
   {
      $this->db->insert($this->table, $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function update($data, $kdPetugas)
   {
      $this->db->set($data);
      $this->db->where('kd_petugas', $kdPetugas);
      $this->db->update('petugas');
      return $this->db->affected_rows() > 0 ? true : false;
   }
   public function delete($id)
   {
      $this->db->delete($this->table, [$this->primary => $id]);
      return $this->db->affected_rows() > 0 ? true : false;
   }
}
