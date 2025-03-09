<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profil_model extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('profil')->row();
    }
    public function slideGetAll()
    {
        return $this->db->get('imgslide')->result();
    }
    
    public function ubahProfil($data)
    {
        $this->db->set($data);
        $this->db->where('id', 1);
        $this->db->update('profil');
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function updateSlide($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('imgslide', $data);
        return $this->db->affected_rows() > 0;
    }
    // public function add($data)
    // {
    //     $this->db->insert('imgslide', $data);
    //     return $this->db->affected_rows() > 0 ? true : false;
    // }
    public function getOne($id)
    {
        return $this->db->get_where('imgslide', ['id' => $id])->row();
        // return $this->db->affected_rows() > 0 ? true : false;
    }
}
