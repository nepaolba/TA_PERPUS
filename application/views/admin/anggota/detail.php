<div class="row">
   <div class="col-lg-12">
      <?php $link = $this->session->flashdata('kembali');  ?>
      <a href="<?= base_url($link ? $link : 'Anggota') ?>" class="btn btn-sm bg-orange">KEMBALI</a>
      <br><br>
   </div <div class="row">
   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-body">
            <table class="table">
               <tr>
                  <td>Nama Lengkap</td>
                  <th>:</th>
                  <td><?= $data['nama_anggota'] ?></td>
               </tr>
               <tr>
                  <td>NIS/NIP</td>
                  <th>:</th>
                  <td><?= $data['kd_anggota'] ?></td>
               </tr>
               <tr>
                  <td>Jenis Kelamin</td>
                  <th>:</th>
                  <td><?= $data['jk'] == '0' ? 'Laki-Laki' : 'Perempuan' ?></td>
               </tr>
               <tr>
                  <td>Nomor HP</td>
                  <th>:</th>
                  <td><?= $data['nohp'] ?></td>
               </tr>
               <tr>
                  <td>Status</td>
                  <th>:</th>
                  <td><?= $data['status_anggota'] == '0' ? 'Guru' : 'Siswa' ?></td>
               </tr>
               <tr>
                  <td>Alamat</td>
                  <th>:</th>
                  <td><?= $data['alamat'] ?></td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <h4 class="box-title">DAFTAR BUKU YANG DIPINJAM</h4>
         </div>
         <div class="box-body">
            <table class="table">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Judul Buku</th>
                     <th>Total Peminjaman</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                  $this->session->set_flashdata(
                     'kembali',
                     'Anggota/detail/' . $this->uri->segment(3)
                  );
                  foreach ($pinjam as $pinjam) : ?>
                     <tr>
                        <td><?= $no++ ?></td>
                        <td>
                           <a href="<?= base_url('Buku/detail/' . $pinjam['kd_buku']) ?>"><?= $pinjam['judul_buku'] ?></a>
                        </td>
                        <td><?= $pinjam['total_pinjam'] ?></td>
                     </tr>
                  <?php endforeach ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>