<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin('admin');
        $this->load->model('Profil_model', 'profil');
        $this->load->helper('notif_helper');
    }
    public function index()
    {
        $data = [
            'breadcrumb' => "PROFIL",
            'data' => $this->profil->getAll(),
            'slide' => $this->profil->slideGetAll(),
            'js' => 'profil.js'
        ];

        $this->viewAdmin('profil/index', $data);
    }

    public function ubahProfil()
    {
        $data = $this->input->post();
        $update =  $this->profil->ubahProfil($data);
        if ($update) {
            notif('Data Berhasil Disimpan', 'success', 'Profil');
        } else {
            notif('Data Gagal Disimpan', 'error', 'Profil');
        }
    }

    // public function tambahSlide()
    // {
    //     $new_image =  $this->checkImage('img');
    //     $insert = $this->profil->add(["img" => $new_image]);
    //     ($insert) ? notif('Data Berhasil Disimpan', 'success', 'Profil') : notif('Data Gagal Disimpan', 'error', 'Profil');
    // }
    public function ubahSlide($id)
    {
        $oldSlide = $this->profil->getOne($id);
        // var_dump($oldSlide);
        $new_image =  $this->checkImage('img');
        $update = $this->profil->updateSlide($id, ["img" => $new_image]);
        // // ($insert) ? notif('Data Berhasil Disimpan', 'success', 'Profil') : notif('Data Gagal Disimpan', 'error', 'Profil');
        if ($update) {
            ($new_image && $oldSlide->img != 'default.jpg') ? unlink(FCPATH . './assets/dist/img/slide/' . $oldSlide->img) : "";
            notif('Data Berhasil Diubah', 'success', 'Profil');
        } else {
            notif('Data Gagal Diubah', 'error', 'Profil');
        }
    }


    public function checkImage($name)
    {
        $upload_image = $_FILES[$name]['name'];
        if ($upload_image) {
            $config['upload_path'] = './assets/dist/img/slide/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']  = '2000';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload($name)) {
                return $this->upload->data('file_name');
            } else {
                notif($this->upload->display_errors(), 'error', 'Buku');
            }
        } else {
            return false;
        }
    }
    //     $data = $this->input->post();
    //     $update =  $this->profil->ubahSambutan($data);
    //     if ($update) {
    //         notif('Data Berhasil Disimpan', 'success', 'Profil');
    //     } else {
    //         notif('Data Gagal Disimpan', 'error', 'Profil');
    //     }
    // }
}

/* End of file Profile.php */
