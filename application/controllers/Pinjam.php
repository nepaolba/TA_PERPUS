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
        $anggota = $this->db->select('kd_anggota, nama_anggota, status_anggota')->order_by('nama_anggota', 'ASC')->get('anggota')->result();
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
    public function perpanjang($id_pinjam, $tgl)
    {
        $oneWeek = date("Y-m-d H:i:s", $tgl + (168 * 60 * 60));
        $this->db->set('tgl_kembali', $oneWeek)->set('status', 3)->where('id_pinjam', $id_pinjam)->update('peminjaman');
        notif('Berhasil diperpanjang', 'success', 'Pinjam');
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

    //! Peminjaman kelas 
    public function simpanPeminjamanKelas()
    {
        $kd_buku = $this->input->post('judul-buku-kelas');
        $kd_anggota = $this->input->post('pilih-anggota-kelas');
        $kelas = $this->input->post('kelas') . '-' . (null != $this->input->post('jurusan')  ? $this->input->post('jurusan') . '-' . $this->input->post('rombel') : $this->input->post('rombel'));
        if ($this->cek_stok_buku($kd_buku)) {
            $hasil = $this->db->select("*")->from('peminjaman')->where('nis_nip', $kd_anggota)->where('kd_buku', $kd_buku)->where('kelas', $kelas)->get()->row();
            if ($hasil) {
                notif('Buku Belum di Kembalikan', 'error', 'Pinjam/tambahPeminjaman');
            } else {
                $post = $this->input->post();
                $data = [
                    "jumlah_pinjam" => $post['jumlah_buku'],
                    "tgl_pinjam" =>  date('Y-m-d') . ' ' . $post['jam'],
                    "tgl_kembali" => date('Y-m-d') . ' ' . $post['tanggal'],
                    "nis_nip" => $kd_anggota,
                    "kd_buku" => $kd_buku,
                    "kd_petugas" => $this->session->userdata('id'),
                    "kelas" => $kelas,
                    "jenis_pinjam" => 1,
                    "status" => 0,
                ];
                $insert = $this->peminjaman->add($data);
                if ($insert) {
                    $ambilDataBuku = $this->buku->getOne($kd_buku);
                    $sisa_stok = $ambilDataBuku['sisa_stok'] - $post['jumlah_buku'];
                    $jumlah_dipinjam = $ambilDataBuku['jumlah_dipinjam'] + $post['jumlah_buku'];
                    $this->buku->update(['sisa_stok' => $sisa_stok, 'jumlah_dipinjam' => $jumlah_dipinjam], $kd_buku);
                    notif('data berhasil disimpan', 'success', 'Pinjam');
                } else {
                    notif('data gagal disimpan', 'error', 'Pinjam');
                }
            }
        } else {
            notif('Stok buku tidak tersedia', 'error', 'Pinjam');
        }
    }
}
