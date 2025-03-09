<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      checkLogin('admin');
      $this->load->model('Category_model', 'category');
      $this->load->helper('notif_helper');
   }

   public function index()
   {
      $data = [
         'breadcrumb' => "KATEGORI BUKU",
         'kategori' => $this->category->getAll(),
         'js' => 'buku.js',
      ];
      $this->viewAdmin('kategori/index', $data);
   }

   public function add()
   {
      $this->form_validation->set_rules('kategori', 'Kategori Buku', 'trim|required');
      if (!$this->form_validation->run()) {
         $this->index();
      } else {
         $insert =  $this->category->add($this->input->post());
         if ($insert) {
            notif('Data Berhasil Disimpan', 'success', 'Kategori');
         } else {
            notif('Data Gagal Disimpan', 'error', 'Kategori');
         }
      }
   }

   public function delete($id)
   {
      $delete = $this->category->delete($id);
      if ($delete) {
         notif('Data Berhasil Dihapus', 'success', 'Kategori');
      } else {
         notif('Data Gagal Dihapus', 'error', 'Kategori');
      }
   }

   public function update($id)
   {
      $update = $this->category->update($this->input->post(), $id);
      if ($update) {
         notif('Data Berhasil Diubah', 'success', 'Kategori');
      } else {
         notif('Data Gagal Diubah', 'error', 'Kategori');
      }
   }
}

/* End of file Kategori.php */
