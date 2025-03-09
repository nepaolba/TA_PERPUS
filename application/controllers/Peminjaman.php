<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
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
        $data = ['breadcrumb' => "PEMINJAMAN", 'peminjaman' => $pinjam, 'js' => 'peminjaman/index.js'];
        $this->viewAdmin('peminjaman/index', $data);
    }

    public function pengajuan_peminjaman_individu()
    {
        $anggota = $this->db->select('kd_anggota, nama_anggota')->where('status_anggota', '1')->get('anggota')->result();
        $data = [
            'breadcrumb' => "Pengajuan Peminjaman Buku Individu",
            'data' => $anggota,
            'js' => 'peminjaman/peminjaman_individu.js'
        ];
        $this->viewAdmin('peminjaman/individu', $data);
    }




    public function cariBukuIndividu($kdAnggota)
    {
        $cek_peminjaman = $this->cek_jumlah_peminjaman_individu($kdAnggota);
        if ($cek_peminjaman) {
            $data = [
                'breadcrumb' => "Cari Buku",
                'dataAnggota' => $this->anggota->getById($kdAnggota),
                'dataBuku' => $this->buku->getAllBuku(),
                'js' => 'peminjaman/caribuku.js'
            ];
            $this->viewAdmin('peminjaman/cariBukuIndividu', $data);
        } else {
            notif('Anda sudah mencapai batas peminjaman buku.', 'error', 'Peminjaman/pengajuan_peminjaman_individu');
        }
    }



    public function getAjaxOneBook()
    {
        $data = $this->buku->getBookDetails($this->input->post('kd_buku'));
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function cekBukuYangSedangDipinjam()
    {
        $kd_anggota = $this->input->post('kd_anggota');
        $kd_buku    = $this->input->post('kd_buku');
        // Ambil data peminjaman berdasarkan kondisi
        $data_peminjaman = $this->db->select('peminjaman.*, buku.sisa_stok')->from('peminjaman')->join('buku', 'buku.kd_buku = peminjaman.kd_buku')->where(['nis_nip' => $kd_anggota, 'peminjaman.kd_buku' => $kd_buku, 'jenis_pinjam' => 0, 'status' => 0])->get()->row();
        // Set header untuk response JSON
        header('Content-Type: application/json');
        // Cek apakah ada data peminjaman
        if (!empty($data_peminjaman)) {
            echo json_encode("buku sedang dipinjam");
        } else {
            // Jika tidak ada peminjaman, periksa stok sebelum proses peminjaman baru
            $buku = $this->db->select('sisa_stok')->from('buku')->where('kd_buku', $kd_buku)->get()->row();
            if ($buku && $buku->sisa_stok > 0) {
                echo json_encode("proses");
            } else {
                echo json_encode("Buku tidak bisa dipinjam, stok habis.");
            }
        }
    }








    public function cekPeminjamanIndividu($kd_anggota, $kodeBuku)
    {
        $hasil = $this->db->select("*")->from('peminjaman')->where('nis_nip', $kd_anggota)->where('kd_buku', $kodeBuku)->where('status', 0)->get()->result();
        ($hasil) ? notif('Buku Belum di Kembalikan', 'error', 'Peminjaman/cariBukuIndividu/' . $kd_anggota) : redirect("Peminjaman/submitPeminjamanIndividu/" . $kd_anggota . "/" . $kodeBuku);
    }

    public function cek_jumlah_peminjaman_individu($kodeAnggota)
    {
        $count_buku = $this->db->select("*")->from('peminjaman')->where('nis_nip', $kodeAnggota)->where('status', 0)->where('jenis_pinjam', 0)->get()->result();
        return count($count_buku) < 3;
    }

    public function submitPeminjamanIndividu($kdAnggota, $kdbuku)
    {
        $data = ['breadcrumb' => "PEMINJAMAN INDIVIDU", 'dataAnggota' => $this->anggota->getById($kdAnggota), 'dataBuku' => $this->buku->getBookDetails($kdbuku), 'js' => 'peminjamanindividu.js'];
        $this->viewAdmin('Peminjaman/submitPeminjamanIndividu', $data);
    }

    public function simpanPeminjamanIndividu($kd_anggota, $kd_buku)
    {
        var_dump($this->input->post());
        // $data = [
        //     "jumlah_pinjam" => 1,
        //     "tgl_pinjam" =>  date('Y-m-d H:i:s'),
        //     "tgl_kembali" => date('Y-m-d H:i:s', strtotime('+1 week')),
        //     "nis_nip" => $kd_anggota,
        //     "kd_buku" => $kd_buku,
        //     "kd_petugas" => $this->session->userdata('id'),
        //     "kelas" => "-",
        //     "jenis_pinjam" => 0,
        //     "status" => 0,
        // ];
        // $insert = $this->peminjaman->add($data);
        // if ($insert) {
        //     // update stok buku
        //     $ambilDataBuku = $this->buku->getOne($kd_buku);
        //     $sisa_stok = $ambilDataBuku['sisa_stok'] - 1;
        //     $jumlah_dipinjam = $ambilDataBuku['jumlah_dipinjam'] + 1;
        //     $this->buku->update(['sisa_stok' => $sisa_stok, 'jumlah_dipinjam' => $jumlah_dipinjam], $kd_buku);
        //     notif('data berhasil disimpan', 'success', 'Peminjaman');
        // } else {
        //     notif('data gagal disimpan', 'error', 'Peminjaman');
        // }
    }

    public function perpanjang($id_pinjam, $tgl)
    {
        $oneWeek = date("Y-m-d H:i:s", $tgl + (168 * 60 * 60));
        $this->db->set('tgl_kembali', $oneWeek)->set('status', 3)->where('id_pinjam', $id_pinjam)->update('peminjaman');
        notif('Berhasil diperpanjang', 'success', 'Peminjaman');
    }

    public function kelompok()
    {
        $anggota = $this->db->select('kd_anggota, nama_anggota')->where('status_anggota', '1')->order_by('nama_anggota')->get('anggota')->result();
        $data = ['breadcrumb' => "PEMINJAMAN KELAS", 'data' => $anggota, 'js' => 'peminjaman_kelompok.js'];
        $this->form_validation->set_rules('kd_anggota', 'NIP/NIS/ID Anggota', 'trim|required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->viewAdmin('peminjaman/kelompok', $data);
        } else {
            $kelas = $this->input->post('kelas') . '-' . (null != $this->input->post('jurusan')  ? $this->input->post('jurusan') . '-' . $this->input->post('rombel') : $this->input->post('rombel'));
            $kd_anggota = $this->input->post('kd_anggota');
            $QueryAnggota = $this->db->get_where('anggota', ['kd_anggota' => $kd_anggota])->row();
            $QueryAnggota ? redirect('Peminjaman/cariBukuKelompok/' . $kd_anggota . '/' . $kelas) : notif('NIS/NIP/ID Anggota Salah', 'error', 'Peminjaman/kelompok');
        }
    }


    public function cariBukuKelompok($kd_anggota, $kelas)
    {
        $anggota = $this->db->select('kd_anggota, nama_anggota, jk, alamat, nohp, status_anggota,tgl_daftar_anggota')->where('kd_anggota', $kd_anggota)->get('anggota')->row_array();
        $data = ['breadcrumb' => "PEMINJAMAN KELAS", 'dataAnggota' => $anggota, 'kelas' => $kelas, 'js' => 'peminjaman_kelompok.js'];
        $this->viewAdmin('peminjaman/cariBukuKelompok', $data);
    }

    public function cekPeminjamanKelompok($kd_anggota, $kodeBuku, $kelas)
    {
        $hasil = $this->db->select("*")->from('peminjaman')->where('nis_nip', $kd_anggota)->where('kd_buku', $kodeBuku)->where('kelas', $kelas)->get()->row();

        ($hasil) ? notif('Buku Belum di Kembalikan', 'error', 'Peminjaman/cariBukuKelompok/' . $kd_anggota . '/' . $kelas) : redirect("Peminjaman/submitPeminjamanKelompok/" . $kd_anggota . "/" . $kodeBuku . "/" . $kelas);
    }

    public function submitPeminjamanKelompok($kdAnggota, $kdbuku, $kelas)
    {
        $data = [
            'breadcrumb' => "PEMINJAMAN KELOMPOK",
            'dataAnggota' => $this->anggota->getById($kdAnggota),
            'kelas' => $kelas,
            'dataBuku' => $this->buku->getBookDetails($kdbuku),
            'js' => 'peminjaman_kelompok.js'
        ];
        $this->viewAdmin('Peminjaman/submitPeminjamanKelompok', $data);
    }


    public function simpanPeminjamanKelompok($kd_anggota, $kd_buku, $kelas)
    {
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
        // var_dump($data);
        $insert = $this->peminjaman->add($data);
        if ($insert) {
            // update stok buku
            $ambilDataBuku = $this->buku->getOne($kd_buku);
            $sisa_stok = $ambilDataBuku['sisa_stok'] - $post['jumlah_buku'];
            $jumlah_dipinjam = $ambilDataBuku['jumlah_dipinjam'] + $post['jumlah_buku'];
            $this->buku->update(['sisa_stok' => $sisa_stok, 'jumlah_dipinjam' => $jumlah_dipinjam], $kd_buku);
            notif('data berhasil disimpan', 'success', 'Peminjaman');
        } else {
            notif('data gagal disimpan', 'error', 'Peminjaman');
        }
    }
}

/* End of file Peminjaman.php */
