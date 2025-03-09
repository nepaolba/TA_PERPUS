<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_Individu extends CI_Controller
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
        $anggota = $this->db->select('kd_anggota, nama_anggota')
            ->where('status_anggota', '1')
            ->order_by('nama_anggota', 'ASC')
            ->get('anggota')
            ->result();

        $kategori = $this->db->order_by('kategori', 'ASC')
            ->get('kategori')
            ->result();

        $data = [
            'breadcrumb' => "Pengajuan Peminjaman Buku Individu",
            'dataAnggota' => $anggota,
            'dataKategori' => $kategori,
            'dataBuku' => $this->buku->getAllBuku(),
            'js' => 'peminjaman/peminjaman_individu.js'
        ];
        $this->viewAdmin('peminjaman/individu', $data);
    }


    public function get_buku_by_kategori()
    {
        $kategori_id = $this->input->post('kategori_id');
        $dataBuku = $this->db->get_where('buku', ['kd_kategori' => $kategori_id])->result(); // Ambil data buku berdasarkan kategori dari model
        echo json_encode(['dataBuku' => $dataBuku]);
    }





    public function cek_jumlah_peminjaman($kd_anggota)
    {
        $peminjaman = $this->db->where('nis_nip', $kd_anggota)
            ->where('jenis_pinjam', '0')
            ->where('status', '0') // Asumsi status '0' berarti buku belum dikembalikan
            ->count_all_results('peminjaman');

        return $peminjaman < 3; // Mengembalikan true jika peminjaman kurang dari 3
    }


    public function cek_stok_buku($kd_buku)
    {
        $buku = $this->db->select('sisa_stok')
            ->where('kd_buku', $kd_buku)
            ->get('buku')
            ->row();

        if ($buku && $buku->sisa_stok > 0) {
            return true; // Stok tersedia
        } else {
            return false; // Stok habis
        }
    }

    public function cek_judul_buku_terpinjam($kd_buku, $kd_anggota)
    {
        $peminjaman = $this->db->where('kd_buku', $kd_buku)
            ->where('nis_nip', $kd_anggota)
            ->where('status', '0')
            ->where('jenis_pinjam', '0')
            ->count_all_results('peminjaman');

        return $peminjaman == 0; // Mengembalikan true jika belum pernah meminjam judul buku ini
    }

    public function pinjam_buku($jumlah_pinjam = 1)
    {
        $kd_buku = $this->input->post('judul-buku');
        $nis_nip = $this->input->post('pilih-anggota');
        $jatu_tempo = $this->input->post('jatu_tempo');
        $kd_petugas = $this->session->userdata('id');
        // Validasi jumlah peminjaman, stok buku, dan judul buku
        if ($this->cek_jumlah_peminjaman($nis_nip)) {
            // Kurangi stok buku
            if ($this->cek_stok_buku($kd_buku)) {
                if ($this->cek_judul_buku_terpinjam($kd_buku, $nis_nip)) {
                    $this->db->set('sisa_stok', 'sisa_stok - ' . $jumlah_pinjam, FALSE)
                        ->where('kd_buku', $kd_buku)
                        ->update('buku');
                    $this->db->set('jumlah_dipinjam', 'jumlah_dipinjam + ' . $jumlah_pinjam, FALSE)
                        ->where('kd_buku', $kd_buku)
                        ->update('buku');

                    // Tambahkan data peminjaman ke tabel 'peminjaman'
                    $data = [
                        'kd_buku' => $kd_buku,
                        'nis_nip' => $nis_nip,
                        'tgl_pinjam' => date('Y-m-d H:i:s'),
                        'tgl_kembali' => $jatu_tempo . date(' H:i:s'),
                        'jumlah_pinjam' => $jumlah_pinjam,
                        'jenis_pinjam' => 0, // Asumsi 0 untuk individu
                        'status' => 0, // 0 berarti belum dikembalikan
                        'kd_petugas' => $kd_petugas
                    ];


                    $this->db->insert('peminjaman', $data);

                    notif('Proses Peminjaman Selesai.', 'success', 'Peminjaman_Individu');
                } else {

                    notif('Anda sedang meminjam buku ini.', 'error', 'Peminjaman_Individu');
                }
            } else {
                notif('Stok buku tidak tersedia', 'error', 'Peminjaman_Individu');
            }
        } else {
            notif('Anda sudah mencapai batas peminjaman buku.', 'error', 'Peminjaman_Individu');
        }
    }














    public function cek_buku_sedang_dipinjam()
    {
        $kd_anggota = $this->input->post('kd_anggota');
        $kd_buku    = $this->input->post('kd_buku');
        // Ambil data peminjaman berdasarkan kondisi
        $data_peminjaman = $this->db->select('peminjaman.*, buku.sisa_stok')
            ->from('peminjaman')->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
            ->where(['nis_nip' => $kd_anggota, 'peminjaman.kd_buku' => $kd_buku, 'jenis_pinjam' => 0, 'status' => 0])
            ->get()->row();
        // Set header untuk response JSON
        header('Content-Type: application/json');
        // Cek apakah ada data peminjaman
        if (!empty($data_peminjaman)) {
            echo json_encode(['status' => 'tidak_lolos']);
        } else {
            // Jika tidak ada peminjaman, periksa stok sebelum proses peminjaman baru
            $buku = $this->db->select('sisa_stok')->from('buku')->where('kd_buku', $kd_buku)->get()->row();
            if ($buku && $buku->sisa_stok > 0) {
                echo json_encode(['status' => 'lolos']);
            } else {
                // echo json_encode("Buku tidak bisa dipinjam, stok habis.");
                echo json_encode(['status' => 'tidak_lolos']);
            }
        }
    }

    // public function cek_jumlah_peminjaman($id_anggota)
    // {
    //     $anggota = $this->db->get_where('peminjaman', ['nis_nip' => $id_anggota, 'jenis_pinjam' => 1])->result();
    //     if (count($anggota) > 3) {
    //         notif('Anda sudah mencapai batas peminjaman buku.', 'error', 'Peminjaman_Individu');
    //         redirect('');
    //     } else {
    //         redirect('Peminjaman_Individu/cari_buku/' . $id_anggota);
    //     }
    // }
}
