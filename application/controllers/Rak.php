<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rak extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('Rack_model', 'rak');
      $this->load->helper('notif_helper');
   }

   public function viewBuku($page, $data = "")
   {
      $this->load->view('admin/layout/head');
      $this->load->view('admin/layout/header');
      $this->load->view('admin/layout/sidebar');
      $this->load->view('admin/layout/breadcrumb', $data);
      $this->load->view('admin/rak/' . $page, $data);
      $this->load->view('admin/layout/footer');
   }

   public function index()
   {
      $rak = $this->rak->getAll();
      $data = ['breadcrumb' => "RAK BUKU", 'js' => 'buku.js', 'rak' => $rak];
      $this->viewBuku('index', $data);
   }

   public function add()
   {
      $this->form_validation->set_rules('nama_rak', 'Kategori Buku', 'trim|required');
      if ($this->form_validation->run() == TRUE) {
         $insert =  $this->rak->add($this->input->post());
         ($insert) ? notif('Data Berhasil Disimpan', 'success', 'Rak') :  notif('Data Gagal Disimpan', 'error', 'Rak');
      } else {
         $this->index();
      }
   }

   public function update($id)
   {
      $update = $this->rak->update($this->input->post(), $id);
      ($update) ? notif('Data Berhasil Diubah', 'success', 'Rak') :  notif('Data Gagal Diubah', 'error', 'Rak');
   }

   public function delete($id)
   {
      $update = $this->rak->delete($id);
      ($update) ? notif('Data Berhasil Dihapus', 'success', 'Rak') :  notif('Data Gagal Dihapus', 'error', 'Rak');
   }
}

/* End of file Rak.php */
