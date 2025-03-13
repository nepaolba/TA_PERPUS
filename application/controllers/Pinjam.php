<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        checkLogin('admin');
        $this->load->model('Peminjaman_model', 'peminjaman');
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Buku_model', 'buku');
        $this->load->helper('text');
        $this->load->helper('notif_helper');
    }

    public function index()
    {
        $pinjam = $this->peminjaman->getAll();
        $data = ['breadcrumb' => "PEMINJAMAN", 'peminjaman' => $pinjam, 'js' => 'pinjam/index.js'];
        $this->viewAdmin('pinjam/index', $data);
    }

    public function tambahPeminjaman()
    {
        $anggota = $this->db->select('kd_anggota, nama_anggota')->order_by('nama_anggota', 'ASC')->get('anggota')->result();
        $kategori = $this->db->order_by('kategori', 'ASC')->get('kategori')->result();
        $data = [
            'breadcrumb' => "PEMINJAMAN BUKU",
            'dataAnggota' => $anggota,
            'dataKategori' => $kategori,
            'dataBuku' => $this->buku->getAllBuku(),
            'js' => 'pinjam/tambahPeminjaman.js'
        ];
        $this->viewAdmin('pinjam/tambahPeminjaman', $data);
    }

    public function simpanPeminjaman()
    {
        $kd_buku = $this->input->post('judul-buku');
        $nis_nip = $this->input->post('pilih-anggota');
        $jatu_tempo = $this->input->post('jatu_tempo');
        $kd_petugas = $this->session->userdata('id');
        $Pinjam = $this->input->post('jumlahPinjam');
        $jumlahPinjam = 1;
        if ($Pinjam) {
            $jumlahPinjam = $Pinjam;
        }
        if ($this->cek_jumlah_peminjaman($nis_nip)) {
            if ($this->cek_stok_buku($kd_buku)) {
                if ($this->cek_judul_buku_terpinjam($kd_buku, $nis_nip)) {
                    $this->db->set('sisa_stok', 'sisa_stok - ' . $jumlahPinjam, FALSE)->where('kd_buku', $kd_buku)->update('buku');
                    $this->db->set('jumlah_dipinjam', 'jumlah_dipinjam + ' . $jumlahPinjam, FALSE)->where('kd_buku', $kd_buku)->update('buku');
                    $data = [
                        'kd_buku' => $kd_buku,
                        'nis_nip' => $nis_nip,
                        'tgl_pinjam' => date('Y-m-d H:i:s'),
                        'tgl_kembali' => $jatu_tempo . date(' H:i:s'),
                        'jumlah_pinjam' => $jumlahPinjam,
                        'jenis_pinjam' => 0,
                        'status' => 0,
                        'kd_petugas' => $kd_petugas
                    ];
                    $this->db->insert('peminjaman', $data);
                    notif('Proses Peminjaman Selesai.', 'success', 'Pinjam');
                } else {
                    notif('Buku sudah dipinjam.', 'error', 'Pinjam');
                }
            } else {
                notif('Stok buku tidak tersedia', 'error', 'Pinjam');
            }
        } else {
            notif('Anda sudah mencapai batas peminjaman buku.', 'error', 'Pinjam');
        }
    }

    public function cek_judul_buku_terpinjam($kd_buku, $kd_anggota)
    {
        $peminjaman = $this->db->where('kd_buku', $kd_buku)->where('nis_nip', $kd_anggota)->where('status', '0')->where('jenis_pinjam', '0')->count_all_results('peminjaman');
        return $peminjaman == 0;
    }


    public function cek_stok_buku($kd_buku)
    {
        $buku = $this->db->select('sisa_stok')->where('kd_buku', $kd_buku)->get('buku')->row();
        if ($buku && $buku->sisa_stok > 0) {
            return true; // Stok tersedia
        } else {
            return false; // Stok habis
        }
    }


    public function cek_jumlah_peminjaman($kd_anggota)
    {
        $anggota = $this->db->get_where('anggota', ['kd_anggota' => $kd_anggota])->row();
        if ($anggota->status_anggota == 1) {
            $peminjaman = $this->db->where('nis_nip', $kd_anggota)->where('jenis_pinjam', '0')->where('status', '0')->count_all_results('peminjaman');
            return $peminjaman < 3;
        } else {
            return true;
        }
    }
    //Peminjaman kelas 


    public function simpanPeminjamanKelas()
    {
        $kd_buku = $this->input->post('judul-buku');
        $nis_nip = $this->input->post('pilih-anggota');
        if ($this->cek_stok_buku($kd_buku)) {
            $kelas = $this->input->post('kelas') . '-' . (null != $this->input->post('jurusan')  ? $this->input->post('jurusan') . '-' . $this->input->post('rombel') : $this->input->post('rombel'));
        } else {
            notif('Stok buku tidak tersedia', 'error', 'Pinjam');
        }
    }
}
