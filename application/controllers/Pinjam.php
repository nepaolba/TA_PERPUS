<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // checkLogin('admin');
        $this->load->model('Peminjaman_model', 'peminjaman');
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Category_model', 'kategori');
        $this->load->model('Buku_model', 'buku');
        $this->load->helper('text');
        $this->load->helper('notif_helper');
    }

    public function index()
    {
        checkLogin('admin');
        $pinjamIndividu = $this->peminjaman->getPeminjamanIndividu();
        $pinjamKelas = $this->peminjaman->getPeminjamanKelas();
        $data = ['breadcrumb' => "PEMINJAMAN", 'peminjaman' => $pinjamIndividu, 'peminjamanKelas' => $pinjamKelas, 'js' => 'pinjam/index.js'];
        $this->viewAdmin('pinjam/index', $data);
    }

    public function tambahPeminjaman()
    {
        //  checkLogin('admin');
        $anggota = $this->anggota->getAnggotaAktif();
        $kategori = $this->kategori->getAll();
        if (!$this->validasiPeminjaman()) {
            $data = [
                'breadcrumb' => "PEMINJAMAN BUKU",
                'dataAnggota' => $anggota,
                'dataKategori' => $kategori,
                'dataBuku' => $this->buku->getAllBuku(),
                'js' => 'pinjam/tambahPeminjaman.js'
            ];
            $this->viewAdmin('pinjam/tambahPeminjaman', $data);
        } else {
            $this->prosesPeminjamanBuku();
        }
    }

    public function prosesPeminjamanBuku()
    {
        $postData = $this->input->post('valid');
        $valid = !empty($postData);
        $pj1 = $this->input->post('pilih-anggota');
        $Pinjam = $this->input->post('jumlahPinjam');
        $kd_buku = $this->input->post('judul-buku');
        $jatu_tempo = $this->input->post('jatu_tempo');
        $tanggal = date('Ymd');
        $nomor_urut = $this->getIdPeminjaman($tanggal);
        $kd_petugas    = $valid ? 0 : $this->session->userdata('id');
        $jumlahPinjam = $Pinjam ? $Pinjam : 1;
        $id_peminjaman = "PJI" . $tanggal . $nomor_urut;

        if ($this->peminjaman->periksaBatasPeminjaman($pj1)) {
            if ($this->peminjaman->periksaKetersediaanStokBuku($kd_buku)) {
                // var_dump(!$this->peminjaman->periksaBukuSudahDipinjam($kd_buku, $pj1));
                // die();
                if ($this->peminjaman->periksaBukuSudahDipinjam($kd_buku, $pj1)) {
                    $simpan = $this->peminjaman->simpanPeminjaman($id_peminjaman, $kd_buku, $pj1, $jatu_tempo, $jumlahPinjam, $kd_petugas);
                    if ($simpan) {
                        $this->buku->updateStokPeminjaman($kd_buku, $jumlahPinjam);
                        $this->buku->updateJumlahPeminjaman($kd_buku, $jumlahPinjam);
                        notif('Proses Peminjaman Selesai.', 'success', !$valid ? 'Pinjam' : 'Welcome/daftarPinjam');
                    } else {
                        notif('Buku Gagal dipinjam.', 'error', !$valid ? 'Pinjam/tambahPeminjaman' : 'Welcome/detailkoleksi');
                    }
                } else {
                    notif('Buku sudah dipinjam.', 'error', !$valid ? 'Pinjam/tambahPeminjaman' : 'Welcome/daftarPinjam');
                }
            } else {
                notif('Stok buku tidak tersedia', 'error', !$valid ? 'Pinjam/tambahPeminjaman' : 'Welcome/detailkoleksi');
            }
        } else {
            notif('Anda sudah mencapai batas peminjaman buku.', 'error', !$valid ? 'Pinjam/tambahPeminjaman' : 'Welcome/daftarPinjam');
        }
    }

    //! Peminjaman kelas 
    public function simpanPeminjamanKelas()
    {
        checkLogin('admin');
        $kd_petugas    =  $this->session->userdata('id');
        $tanggal = date('Ymd');
        $nomor_urut = $this->getIdPeminjaman($tanggal);
        $id_peminjaman = "PJK" . $tanggal . $nomor_urut;
        $jumlahPinjam = $this->input->post('jumlah_buku');
        $kd_buku = $this->input->post('judul-buku-kelas');
        $pj1 = $this->input->post('pilih-anggota-kelas1');
        $pj2 = $this->input->post('pilih-anggota-kelas2');
        $jamkembali = date('Y-m-d ') . $this->input->post('tanggal');
        $kelas = $this->input->post('kelas') . '-' . (null != $this->input->post('jurusan')  ? $this->input->post('jurusan') . '-' . $this->input->post('rombel') : $this->input->post('rombel'));
        var_dump($this->peminjaman->periksaBatasPeminjamanKelas($kelas));
        if ($this->peminjaman->periksaBatasPeminjamanKelas($kelas)) {
            if ($this->peminjaman->periksaKetersediaanStokBuku($kd_buku)) {
                if ($this->peminjaman->periksaBukuDipinjam($kd_buku, $kelas)) {
                    $simpan = $this->peminjaman->simpanPeminjamankelas($id_peminjaman, $kd_buku, $pj1, $jamkembali, $jumlahPinjam, $kd_petugas, $pj2, $kelas);
                    if ($simpan) {
                        $this->buku->updateStokPeminjaman($kd_buku, $jumlahPinjam);
                        $this->buku->updateJumlahPeminjaman($kd_buku, $jumlahPinjam);
                        notif('Proses Peminjaman Selesai.', 'success', 'Pinjam');
                    } else {
                        notif('Buku Gagal dipinjam.', 'error', 'Pinjam/tambahPeminjaman');
                    }
                } else {
                    notif('Buku sudah dipinjam.', 'error', 'Pinjam/tambahPeminjaman');
                }
            } else {
                notif('Stok buku tidak tersedia', 'error', 'Pinjam/tambahPeminjaman');
            }
        } else {
            notif('Anda sudah mencapai batas peminjaman buku.', 'error',  'Pinjam/tambahPeminjaman');
        }
    }

    // validasi peminjaman buku individu
    private function validasiPeminjaman()
    {
        $postData = $this->input->post('valid');
        $valid = !empty($postData);
        if (!$valid) {
            $jumlahInput = count($this->input->post());
            $this->form_validation->set_rules('pilih-anggota', 'Anggota', 'required', ['required' => 'Anda harus memilih anggota yang meminjam buku.']);
            $this->form_validation->set_rules('kategori-buku', 'Kategori Buku', 'required', ['required' => 'Anda harus memilih kategori buku.']);
            $this->form_validation->set_rules('judul-buku', 'Judul Buku', 'required', ['required' => 'Anda harus memilih judul buku.']);
            $this->form_validation->set_rules('jatu_tempo', 'Tanggal Jatuh Tempo', 'required', ['required' => 'Anda harus mengisi tanggal jatuh tempo peminjaman.']);
            if ($jumlahInput > 5) {
                $this->form_validation->set_rules('jumlahPinjam', 'Jumlah Pinjam', 'integer|greater_than[0]|required', [
                    'integer' => 'Jumlah pinjam harus berupa angka.',
                    'greater_than' => 'Jumlah pinjam harus lebih dari 0.',
                    'required' => 'Jumalah Peminjaman harus diisi.'
                ]);
            }
            return $this->form_validation->run();
        } else {
            return $valid;
        }
    }

    public function getIdPeminjaman($tanggal)
    {
        $tgl = date('Y-m-d', strtotime($tanggal));
        $this->db->select("LPAD(COUNT(*) + 1, 4, '0') AS nomor_urut");
        $this->db->from("peminjaman");
        $this->db->where("DATE(tgl_pinjam) =", $tgl);
        $query = $this->db->get();
        $result = $query->row();
        $nomor_urut = $result ? $result->nomor_urut : $nomor_urut = '0001';
        return $nomor_urut;
    }

    public function get_kategori()
    {
        $kategori = $this->kategori->getAll();
        echo json_encode($kategori);
    }

    public function get_status_anggota()
    {
        $anggota = $this->anggota->getById($this->input->post('kd_anggota'));
        echo ($anggota) ? json_encode($anggota) : json_encode(['msg' => 'Data tidak ditemukan']);
    }

    public function get_buku_by_kategori()
    {
        $kategori_id = $this->input->post('kategori_id');
        $dataBuku = $this->db->get_where('buku', ['kd_kategori' => $kategori_id])->result();
        echo json_encode(['dataBuku' => $dataBuku]);
    }

    public function ajax_validasi_peminjaman()
    {
        $kdBuku = $this->input->post('kd_buku');
        $kdAnggota = $this->input->post('kd_anggota');
        $peminjaman = $this->peminjaman->periksaBukuSudahDipinjam($kdBuku, $kdAnggota);
        echo json_encode($peminjaman);
    }

    public function perpanjang($id_pinjam, $tgl)
    {
        $oneWeek = date("Y-m-d H:i:s", $tgl + (168 * 60 * 60));
        $this->db->set('tgl_kembali', $oneWeek)->set('status', 'perpanjang')->where('id_pinjam', $id_pinjam)->update('peminjaman');
        notif('Berhasil diperpanjang', 'success', 'Pinjam');
    }
    public function verifikasi()
    {
        $id_pinjam = $this->input->post('id_pinjam');
        $tgl_kembali = $this->input->post('tgl_kembali') . date(" H:i:s");
        $update = $this->db->set('status', 'dipinjam')
            ->set('tgl_kembali', $tgl_kembali)
            ->where('id_pinjam', $id_pinjam)
            ->update('peminjaman');

        if ($update) {
            notif('Berhasil diverifikasi', 'success', 'Pinjam');
        } else {
            notif('Gagal diverifikasi', 'error', 'Pinjam');
        }
        // notif('Berhasil diverifikasi', 'success', 'Pinjam');
    }
}
