<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Peminjaman_model', 'pinjam');
        $this->session->set_userdata('new_role', 'Anggota');
        checkLogin('admin');
    }

    public function index()
    {
        $data = [
            'breadcrumb' => "ANGGOTA",
            'data' => $this->anggota->getAll(),
            'js' => 'anggota.js'
        ];

        $this->viewAdmin('anggota/anggota', $data);
    }

    public function detail($kdAnggota)
    {
        $pinjam = $this->pinjam->joinGetCodeAnggota($kdAnggota);
        $anggota = $this->anggota->getById($kdAnggota);
        $data = ['breadcrumb' => "DETAIL ANGGOTA", 'data' => $anggota, 'js' => 'anggota.js', 'pinjam' => $pinjam];
        $this->viewAdmin('anggota/detail', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('status_anggota', 'Status', 'trim|required');
        $this->form_validation->set_rules('kd_anggota', 'NIP/NIS/Username', 'trim|required|max_length[20]|is_unique[anggota.kd_anggota]');
        $this->form_validation->set_rules('nama_anggota', 'Nama', 'trim|required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('nohp', 'Nomor HP', 'trim|required|min_length[11]');
        $data = ['breadcrumb' => "Tambah Anggota", 'js' => 'addAnggota.js'];

        if ($this->form_validation->run() == FALSE) {
            $this->viewAdmin('anggota/addAnggota', $data);
        } else {
            $array = $this->input->post();
            $marge = $array + ['password' => password_hash($array['kd_anggota'], PASSWORD_DEFAULT)];
            $insert = $this->anggota->insert($marge);
            if ($insert) {
                $this->session->set_flashdata(['msg' => "Data Berhasil Disimpan", "class" => "success"]);
                redirect('Anggota');
            } else {
                $this->session->set_flashdata(['msg' => "Data Gagal Disimpan", "class" => "error"]);
                redirect('Anggota');
            }
        }
    }

    public function update($kdAnggota)
    {
        $oldKdAnggota = $this->anggota->getById($kdAnggota);
        $this->form_validation->set_rules('status_anggota', 'Status', 'trim|required');
        if ($this->input->post('kd_anggota') !=  $oldKdAnggota['kd_anggota']) {
            $this->form_validation->set_rules('kd_anggota', 'NIP/NIS/Username', 'trim|required|max_length[20]|is_unique[anggota.kd_anggota]');
        }
        $this->form_validation->set_rules('nama_anggota', 'Nama', 'trim|required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('nohp', 'Nomor HP', 'trim|required|min_length[11]');
        $data = ['breadcrumb' => "Ubah Data Anggota", 'js' => 'addAnggota.js', 'data' => $this->anggota->getById($kdAnggota)];
        if ($this->form_validation->run() == FALSE) {
            $this->viewAdmin('anggota/updateAnggota', $data);
        } else {
            $array = $this->input->post();
            $marge = $array + ['password' => password_hash($array['kd_anggota'], PASSWORD_DEFAULT)];
            $update = $this->anggota->update($marge, $kdAnggota);
            if ($update) {
                $this->session->set_flashdata(['msg' => "Data Berhasil Diubah", "class" => "success"]);
                redirect('Anggota');
            } else {
                $this->session->set_flashdata(['msg' => "Data Gagal Diubah", "class" => "error"]);
                redirect('Anggota');
            }
        }
    }

    public function getAjaxAnggota($kdAnggota)
    {
        $anggota = $this->anggota->getById($kdAnggota);
        echo json_encode($anggota);
    }
    // baru dibuat
    public function getAjaxAnggotaById()
    {
        // var_dump($this->input->post('kd_anggota'));
        $anggota = $this->anggota->getById($this->input->post('kd_anggota'));
        if ($anggota) {
            echo json_encode($anggota);
        } else {
            echo json_encode(['msg' => 'Data tidak ditemukan']);
        };
    }

    public function delete($kdAnggota)
    {
        $delete = $this->anggota->delete($kdAnggota);
        if ($delete) {
            $this->session->set_flashdata(['msg' => "Data Berhasil Dihapus", "class" => "success"]);
            redirect('Anggota');
        } else {
            $this->session->set_flashdata(['msg' => "Data Gagal Dihapus", "class" => "error"]);
            redirect('Anggota');
        }
    }
}
