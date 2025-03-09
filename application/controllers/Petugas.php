<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      checkLogin('admin');
      $this->load->model('Petugas_model', 'petugas');
      $this->load->helper('notif_helper');
   }
   public function index()
   {
      $data = [
         'breadcrumb' => "PETUGAS",
         'petugas' => $this->petugas->getAll(),
         'js' => 'petugas.js',
      ];
      $this->viewAdmin('petugas/index', $data);
   }
   public function add()
   {
      $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required');
      $this->form_validation->set_rules('jk_petugas', 'Jenis Kelamin', 'required');
      $this->form_validation->set_rules('alamat_petugas', 'Alamat', 'required');
      $this->form_validation->set_rules('nohp_petugas', 'No HP', 'required|regex_match[/^\+?\d{10,12}$/]');
      $this->form_validation->set_rules('username', 'Username', 'required|is_unique[petugas.username]');

      $data = [
         'breadcrumb' => "TAMBAH PETUGAS",
         'js' => 'petugas.js',
      ];
      if ($this->form_validation->run() == FALSE) {
         $this->viewAdmin('petugas/add', $data);
      } else {
         $setNewData = ['foto_petugas' => 'default.png', 'password' => password_hash($this->input->post('username'), PASSWORD_DEFAULT)];
         $gabung = array_merge($this->input->post(), $setNewData);
         $insert =  $this->petugas->add($gabung);
         ($insert) ? notif('Data Berhasil Disimpan', 'success', 'Petugas') : notif('Data Gagal Disimpan', 'error', 'Petugas');
      }
   }
   public function update($kdPetugas)
   {
      // $oldUsername = $this->petugas->getById($kdPetugas);
      $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required');
      $this->form_validation->set_rules('jk_petugas', 'Jenis Kelamin', 'required');
      $this->form_validation->set_rules('alamat_petugas', 'Alamat', 'required');
      $this->form_validation->set_rules('nohp_petugas', 'No HP', 'required');
      $data = [
         'breadcrumb' => "UBAH PETUGAS",
         'petugas' => $this->petugas->getById($kdPetugas),
         'js' => 'petugas.js',
      ];
      if ($this->form_validation->run() == FALSE) {
         $this->viewAdmin('petugas/update', $data);
      } else {
         $dataPost = $this->input->post();
         $new_image =  $this->checkImage('foto_petugas');
         if ($new_image) {
            $dataPost = array_merge($this->input->post(), ['foto_petugas' => $new_image]);
         }
         $update =  $this->petugas->update($dataPost, $kdPetugas);
         if ($update) {
            if ($new_image) {
               unlink(FCPATH . './assets/dist/img/petugas/' . $data['petugas']->foto_petugas);
            }
            notif('Data Berhasil Diubah', 'success', 'Petugas');
         } else {
            notif('Data Gagal Diubah', 'error', 'Buku');
         }
      }
   }
   public function checkImage($name)
   {
      $upload_image = $_FILES[$name]['name'];
      if ($upload_image) {
         $config['upload_path'] = './assets/dist/img/petugas/';
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size']  = '2000';
         $this->load->library('upload', $config);
         if ($this->upload->do_upload($name)) {
            $new_image = $this->upload->data('file_name');
            return $new_image;
         } else {
            notif($this->upload->display_errors(), 'error', 'Petugas');
         }
      } else {
         return false;
      }
   }
   public function resetPassword($kdPetugas)
   {
      $query = $this->petugas->getById($kdPetugas);
      $pass = ['password' => password_hash($query->username, PASSWORD_DEFAULT)];
      $reset =  $this->petugas->update($pass, $kdPetugas);
      ($reset) ? notif('Password Berhasil Direset', 'success', 'Petugas') : notif('Password Gagal Direset', 'error', 'Petugas');
   }

   public function delete($id)
   {
      $delete = $this->petugas->delete($id);
      if ($delete) {
         notif('Data Berhasil Dihapus', 'success', 'Petugas');
      } else {
         notif('Data Gagal Dihapus', 'error', 'Petugas');
      }
   }
}

/* End of file Petugas.php */
