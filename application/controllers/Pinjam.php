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
                if (!$this->peminjaman->periksaBukuSudahDipinjam($kd_buku, $pj1)) {
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
        $tanggal = date('Ymd'); // Format tanggal YYYYMMDD
        $nomor_urut = $this->getIdPeminjaman($tanggal); // Dapatkan nomor urut untuk hari ini
        $id_peminjaman = "PJK" . $tanggal . $nomor_urut; // Gabungkan tanggal dan nomor urut
        $kd_buku = $this->input->post('judul-buku-kelas');
        $pj1 = $this->input->post('pilih-anggota-kelas1');
        $pj2 = $this->input->post('pilih-anggota-kelas2');
        $kelas = $this->input->post('kelas') . '-' . (null != $this->input->post('jurusan')  ? $this->input->post('jurusan') . '-' . $this->input->post('rombel') : $this->input->post('rombel'));
        if ($this->peminjaman->periksaBatasPeminjaman($pj1, $pj2)) {
            if ($this->peminjaman->periksaKetersediaanStokBuku($kd_buku)) {
                echo 'stok ada';
            } else {
                echo 'stok hBIS';
            }
        } else {
            echo 'blm mengembalikan buku';
        }
        // if ($this->cek_stok_buku($kd_buku)) {
        //     $hasil = $this->db->select("*")->from('peminjaman')->where('pj1', $kd_anggota)->where('kd_buku', $kd_buku)->where('kelas', $kelas)->get()->row();
        //     if ($hasil) {
        //         notif('Buku Belum di Kembalikan', 'error', 'Pinjam/tambahPeminjaman');
        //     } else {
        //         $post = $this->input->post();
        //         $data = [
        //             'id_pinjam' => $id_peminjaman,
        //             "jumlah_pinjam" => $post['jumlah_buku'],
        //             "tgl_pinjam" =>  date('Y-m-d') . ' ' . $post['jam'],
        //             "tgl_kembali" => date('Y-m-d') . ' ' . $post['tanggal'],
        //             "pj1" => $kd_anggota,
        //             "kd_buku" => $kd_buku,
        //             "kd_petugas" => $this->session->userdata('id'),
        //             "kelas" => $kelas,
        //             "jenis_pinjam" => 1,
        //             "status" => 'dipinjam',
        //         ];
        //         $insert = $this->peminjaman->add($data);
        //         if ($insert) {
        //             $ambilDataBuku = $this->buku->getOne($kd_buku);
        //             $sisa_stok = $ambilDataBuku['sisa_stok'] - $post['jumlah_buku'];
        //             $jumlah_dipinjam = $ambilDataBuku['jumlah_dipinjam'] + $post['jumlah_buku'];
        //             $this->buku->update(['sisa_stok' => $sisa_stok, 'jumlah_dipinjam' => $jumlah_dipinjam], $kd_buku);
        //             notif('data berhasil disimpan', 'success', 'Pinjam');
        //         } else {
        //             notif('data gagal disimpan', 'error', 'Pinjam');
        //         }
        //     }
        // } else {
        //     notif('Stok buku tidak tersedia', 'error', 'Pinjam');
        // }
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
    // public function getIdPeminjaman($tanggal)
    // {
    //     $tgl = date('Ymd', strtotime($tanggal)); // Format: 20250426
    //     $prefix = 'PJI' . $tgl;

    //     // Ambil ID terakhir yang dimulai dengan prefix tanggal itu
    //     $this->db->select("RIGHT(id_pinjam, 4) AS nomor_urut");
    //     $this->db->from("peminjaman");
    //     $this->db->like("id_pinjam", $prefix, 'after'); // WHERE id_peminjaman LIKE 'PJI20250426%'
    //     $this->db->order_by("id_pinjam", "DESC");
    //     $this->db->limit(1);
    //     $query = $this->db->get();

    //     if ($query->num_rows() > 0) {
    //         $last_number = (int) $query->row()->nomor_urut;
    //         $new_number = $last_number + 1;
    //     } else {
    //         $new_number = 1;
    //     }

    //     $nomor_urut = str_pad($new_number, 4, '0', STR_PAD_LEFT);
    //     return $prefix . '-' . $nomor_urut; // Contoh hasil: PJI20250426-0007
    // }
    // public function getIdPeminjaman($tanggal)
    // {
    //     $tgl = date('Y-m-d', strtotime($tanggal));

    //     // Generate nomor urut berdasarkan tanggal
    //     $this->db->select("LPAD(COUNT(*) + 1, 4, '0') AS nomor_urut");
    //     $this->db->from("peminjaman");
    //     $this->db->where("DATE(tgl_pinjam) =", $tgl);
    //     $query = $this->db->get();

    //     $result = $query->row();

    //     // Jika tidak ada transaksi, mulai dengan nomor urut '0001'
    //     $nomor_urut = ($result) ? $result->nomor_urut : '0001';

    //     // Membuat id transaksi yang unik
    //     $id_pinjam = 'PJI' . date('Ymd', strtotime($tgl)) . $nomor_urut;

    //     // Cek apakah id_pinjam sudah ada di database
    //     $this->db->where('id_pinjam', $id_pinjam);
    //     $exists = $this->db->count_all_results('peminjaman');

    //     // Jika id sudah ada, coba lagi dengan menambahkan nomor urut yang lebih besar
    //     if ($exists > 0) {
    //         return $this->getIdPeminjaman($tanggal); // Rekursif untuk mencoba lagi
    //     }

    //     return $id_pinjam;
    // }
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
    public function verifikasi($id_pinjam)
    {
        $this->db->set('status', 'dipinjam')->where('id_pinjam', $id_pinjam)->update('peminjaman');
        notif('Berhasil diverifikasi', 'success', 'Pinjam');
    }
}
