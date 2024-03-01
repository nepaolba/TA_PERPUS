<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Anggota_model extends CI_Model
{

   public function getAll()
   {
      return $this->db->get('anggota')->result_array();
   }

   public function getById($id)
   {
      return $this->db->get_where('anggota', ['kd_anggota' => $id])->row_array();
   }

   public function insert($data)
   {
      $data['tgl_daftar_anggota'] = date('Y-m-d');
      $insert = $this->db->insert('anggota', $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function update($data, $kdAnggota)
   {
      $this->db->where('kd_anggota', $kdAnggota);
      $this->db->update('anggota', $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function delete($kdAnggota)
   {
      $this->db->where('kd_anggota', $kdAnggota);
      $delete = $this->db->delete('anggota');
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function countAnggota()
   {
      return $this->db->count_all('anggota');
   }
   public function getJumlahAnggotaBaruHariIni()
   {
      $today = date('Y-m-d');
      $this->db->select('COUNT(kd_anggota) as jumlah_anggota_baru');
      $this->db->from('anggota');
      $this->db->where('tgl_daftar_anggota', $today);
      $query = $this->db->get();
      $result = $query->row();

      return $result->jumlah_anggota_baru;
   }
}

/* End of file Anggota_model.php */
