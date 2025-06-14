<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_model extends CI_Model
{

   public function getAll()
   {
      $query = $this->db->select('*')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->join('anggota', 'anggota.kd_anggota = peminjaman.pj1')
         ->join('rak', 'rak.id_rak = buku.id_rak')
         ->join('kategori', 'kategori.kd_kategori = buku.kd_kategori')
         ->join('petugas', 'petugas.kd_petugas = peminjaman.kd_petugas')
         ->where('peminjaman.status !=', 1)
         ->order_by('peminjaman.id_pinjam', 'DESC')
         ->get()->result_array();
      return $query;
   }

   public function getPeminjamanIndividu()
   {
      $query = $this->db->select('*')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->join('anggota', 'anggota.kd_anggota = peminjaman.pj1')
         ->join('rak', 'rak.id_rak = buku.id_rak')
         ->join('kategori', 'kategori.kd_kategori = buku.kd_kategori')
         ->join('petugas', 'petugas.kd_petugas = peminjaman.kd_petugas', 'left')
         ->where('peminjaman.status !=', 'dikembalikan')
         ->where('peminjaman.jenis_pinjam =', 0)
         ->order_by('peminjaman.id_pinjam', 'DESC')
         ->get()->result_array();
      return $query;
   }
   public function getPeminjamanKelas()
   {
      $query = $this->db->select('*')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->join('anggota', 'anggota.kd_anggota = peminjaman.pj1')
         ->join('rak', 'rak.id_rak = buku.id_rak')
         ->join('kategori', 'kategori.kd_kategori = buku.kd_kategori')
         ->join('petugas', 'petugas.kd_petugas = peminjaman.kd_petugas')
         ->where('peminjaman.status !=', 'dikembalikan')
         ->where('peminjaman.jenis_pinjam =', 1)
         ->order_by('peminjaman.id_pinjam', 'DESC')
         ->get()->result_array();
      return $query;
   }

   public function periksaBatasPeminjaman($kd_anggota)
   {
      $anggota = $this->db->get_where('anggota', ['kd_anggota' => $kd_anggota])->row();
      if (!$anggota) {
         return false;
      }
      if ($anggota->jenis_anggota == 1) {
         $this->db->from('peminjaman');
         $this->db->where('pj1', $kd_anggota);
         $this->db->where('jenis_pinjam', '0');
         $this->db->where('status !=', 'dikembalikan'); // ini poin utamanya
         $peminjaman = $this->db->count_all_results();
         // log_message('debug', 'Hasil cek buku dipinjam: ' . $this->db->last_query());
         return (int)$peminjaman < 3;
      }
      return true;
   }

   public function periksaBatasPeminjamanKelas($kelas)
   {
      $peminjaman = $this->db->where('kelas', $kelas)->where('status', 'dipinjam')->count_all_results('peminjaman');
      return $peminjaman < 1;
   }

   public function periksaKetersediaanStokBuku($kd_buku)
   {
      $buku = $this->db->select('sisa_stok')->where('kd_buku', $kd_buku)->get('buku')->row();
      return ($buku && $buku->sisa_stok > 0);
   }

   public function periksaBukuSudahDipinjam($kd_buku, $kd_anggota)
   {
      $peminjaman = $this->db
         ->where('kd_buku', $kd_buku)
         ->where('pj1', $kd_anggota)
         ->where('jenis_pinjam', '0')
         ->where('status !=', 'dikembalikan')
         ->count_all_results('peminjaman');
      return $peminjaman < 1;
   }

   public function periksaBukuDipinjam($kd_buku, $kelas)
   {
      $peminjaman = $this->db
         ->where('kd_buku', $kd_buku)
         ->where('kelas', $kelas)
         // ->where('pj2', $pj2)
         ->where('jenis_pinjam', '1')
         ->where('status !=', 'dikembalikan')
         ->count_all_results('peminjaman');
      return $peminjaman < 1;
   }

   public function simpanPeminjaman($id_peminjaman, $kd_buku, $pj1, $jatu_tempo, $jumlahPinjam, $kd_petugas, $pj2 = "")
   {
      $data = array(
         'id_pinjam'     => $id_peminjaman,
         'kd_buku'       => $kd_buku,
         'pj1'           => $pj1,
         'tgl_pinjam'    => date('Y-m-d H:i:s'),
         'tgl_kembali'   => $jatu_tempo . date(' H:i:s'),
         'jumlah_pinjam' => $jumlahPinjam,
         'jenis_pinjam'  => 0,
         'status'        => 'pandding'
      );

      if ($pj2) {
         $data['pj2'] = $pj2;
      }

      if ($kd_petugas != "0") {
         $data['kd_petugas'] = $kd_petugas;
         $data['status'] = 'dipinjam';
      }
      return $this->db->insert('peminjaman', $data); // Simpan ke database
   }

   public function simpanPeminjamanKelas($id_peminjaman, $kd_buku, $pj1, $jatu_tempo, $jumlahPinjam, $kd_petugas, $pj2, $kelas)
   {
      $data = array(
         'id_pinjam'     => $id_peminjaman,
         'kd_buku'       => $kd_buku,
         'pj1'           => $pj1,
         'pj2'           => $pj2,
         'tgl_pinjam'    => date('Y-m-d H:i:s'),
         'tgl_kembali'   => $jatu_tempo,
         'jumlah_pinjam' => $jumlahPinjam,
         'jenis_pinjam'  => 1,
         'kd_petugas'    => $kd_petugas,
         'status'        => 'dipinjam',
         'kelas'         => $kelas
      );
      return $this->db->insert('peminjaman', $data); // Simpan ke database
   }





















   public function countPinjam()
   {
      return $this->db->count_all('peminjaman');
   }

   // dipake di controller peminjaman untuk cek buku yg sedang dipinjam
   public function joinAnggotaBuku($kdanggota, $kdbuku)
   {
      $this->db->select('*')
         ->from('peminjaman')
         ->join('anggota', 'anggota.kd_anggota = peminjaman.nis_nip')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->where('peminjaman.kd_buku', $kdbuku)
         ->where('peminjaman.nis_nip', $kdanggota)
         ->where('status', 0)
         ->group_by('anggota.kd_anggota, anggota.nama_anggota');

      return $this->db->get()->result_array();
   }
   public function add($data)
   {
      $this->db->insert('peminjaman', $data);
      return $this->db->affected_rows() > 0 ? true : false;
   }
   // private function updateStokBuku($kd_buku, $jumlah_pinjam) {
   //       // Update stok buku menggunakan set
   //       $this->db->set('jumlah_buku', 'jumlah_buku - ' . $jumlah_pinjam, false);
   //       $this->db->where('kode_buku', $kd_buku);
   //       $this->db->update('_buku');
   //   }

   public function delete($id_pinjam)
   {
      // var_dump($id_pinjam);

      $this->db->where('id_pinjam', $id_pinjam)
         ->delete('peminjaman');
      return $this->db->affected_rows() > 0 ? true : false;
   }

   public function getCodeBook($code)
   {
      $this->db->select('*')
         ->from('peminjaman')
         ->where('kd_buku', $code);
      return $this->db->get()->result_array();
   }


   public function getPeminjam($kd_buku, $kd_anggota, $jenis_pinjam)
   {
      $this->db->select('*');
      $this->db->from('peminjaman');
      $this->db->where('kd_buku', $kd_buku);
      $this->db->where('nis_nip', $kd_anggota);
      $this->db->where('jenis_pinjam', $jenis_pinjam);
      $this->db->where('status', 0);
      $query = $this->db->get();
      // var_dump($query->result_array());
      if ($query->num_rows() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function joinGetCodeBook($code)
   {
      $this->db->select('peminjaman.*,anggota.kd_anggota, anggota.nama_anggota, SUM(peminjaman.jumlah_pinjam) as total_pinjam')
         ->from('peminjaman')
         ->join('anggota', 'anggota.kd_anggota = peminjaman.nis_nip')
         ->where('kd_buku', $code)
         ->where('status', 0)
         ->group_by('anggota.kd_anggota, anggota.nama_anggota');

      return $this->db->get()->result_array();
   }
   public function joinGetCodeAnggota($code)
   {
      $this->db->select('peminjaman.*, buku.judul_buku, SUM(peminjaman.jumlah_pinjam) as total_pinjam')
         ->from('peminjaman')
         ->join('buku', 'buku.kd_buku = peminjaman.kd_buku')
         ->where('pj1', $code)
         ->group_by('buku.kd_buku, buku.judul_buku');
      return $this->db->get()->result_array();
   }

   public function getJumlahPeminjamanPerBulan($tahun)
   {
      // Ambil jumlah peminjaman per bulan
      $this->db->select('MONTH(tgl_pinjam) AS bulan, COUNT(*) AS jumlah');
      $this->db->from('peminjaman');
      $this->db->where('YEAR(tgl_pinjam)', $tahun);
      $this->db->group_by('MONTH(tgl_pinjam)');
      $query1 = $this->db->get();
      $peminjaman = $query1->result_array();


      // Ambil jumlah pengembalian per bulan dari tabel pengembalian
      $this->db->select('MONTH(tgl) AS bulan, COUNT(*) AS jumlah');
      $this->db->from('pengembalian');
      $this->db->where('YEAR(tgl)', $tahun);
      $this->db->group_by('MONTH(tgl)');
      $query2 = $this->db->get();
      $pengembalian = $query2->result_array();

      return [
         'peminjaman' => $peminjaman,
         'pengembalian' => $pengembalian
      ];
   }

   public function getJumlahPeminjamHariIni()
   {
      $today = date('Y-m-d');
      $this->db->select('COUNT(id_pinjam) as jumlah_pinjam');
      $this->db->from('peminjaman');
      $this->db->like('tgl_pinjam', $today);
      $query = $this->db->get();
      $result = $query->row();
      return $result->jumlah_pinjam;
   }
   //baru
   public function getJumlahPeminjamJatuhTempoHariIni()
   {
      $today = date('Y-m-d'); // Ambil tanggal hari ini
      $this->db->select('COUNT(id_pinjam) as jumlah_peminjam_jatuh_tempo');
      $this->db->from('peminjaman');
      $this->db->like('tgl_kembali', $today);
      $query = $this->db->get();
      $result = $query->row();
      return $result->jumlah_peminjam_jatuh_tempo;
   }
   public function getOne($id)
   {
      return $this->db->get_where("peminjaman", ["id_pinjam" => $id])->row_array();
   }
}

/* End of file Peminjaman_model.php */
