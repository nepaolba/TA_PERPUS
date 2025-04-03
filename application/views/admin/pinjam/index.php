<!-- <style>
   #peminjaman_filter {
      display: flex;
      align-items: end !important;
   }
</style> -->
<div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
<div class="row">
   <div class="col-md-12">
      <div class="box-header" style="padding-left: 0 !important;">
         <a href="<?= base_url('Pinjam/tambahPeminjaman') ?>" class="btn btn-success"><i class="fa fa-upload"></i> Tambah Peminjaman Baru</a>
      </div>
   </div>
   <div class="col-md-12">
      <div class="nav-tabs-custom">
         <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Individu</a></li>
            <li><a href="#settings" data-toggle="tab">Kelas</a></li>
         </ul>
         <div class="tab-content">
            <div class="tab-pane  active" id="activity">
               <div class="row">
                  <div class="col-lg-12 ">
                     <div class="alert alert-info alert-custom">
                        <ul>
                           <li style="list-style: none; display:flex;align-items: center; margin-left: -25px; font-size: 15px;"><i class="fa fa-info-circle" style="font-size: 25px;"></i> &nbsp;INFORMASI</li>
                           <li> Perpanjang peminjaman hanya bisa dilakukan satu kali</li>
                           <li> Masa lama perpanjang peminjaman 1 minggu / 7 hari</li>
                        </ul>
                     </div>

                     <table class="table" id="peminjaman">
                        <thead>
                           <tr>
                              <th>ID Pinjam</th>
                              <th>Anggota</th>
                              <th>Buku</th>
                              <th>Tgl Pinjam</th>
                              <th>Tenggat</th>
                              <th>Jumlah Pinjam</th>
                              <th>Status</th>
                              <th>#</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $this->session->set_flashdata('kembali', 'Pinjam') ?>
                           <?php foreach ($peminjaman as  $pinjam) : ?>
                              <tr>
                                 <td>
                                    <?= $pinjam['id_pinjam'] ?>
                                 </td>
                                 <td>
                                    <a href="<?= base_url('Anggota/detail/' . $pinjam['pj1']) ?>"><?= $pinjam['nama_anggota'] ?></a>
                                 </td>
                                 <td>
                                    <a href="<?= base_url('Buku/detail/' . $pinjam['kd_buku']) ?>"> <?= character_limiter($pinjam['judul_buku'], 70); ?></a>
                                 </td>
                                 <td>
                                    <?= date("d/m/Y - H:i:s", strtotime($pinjam['tgl_pinjam'])) ?>
                                 </td>
                                 <td>
                                    <?= date("d/m/Y - H:i:s", strtotime($pinjam['tgl_kembali'])) ?>
                                 </td>
                                 <td class="text-center"><?= $pinjam['jumlah_pinjam'] ?></td>
                                 <td class="text-center"><?= $pinjam['status'] ?></td>
                                 <td>
                                    <?php if ($pinjam['status'] != 'dipinjam' && $pinjam['status'] != 'perpanjang'): ?>
                                       <a href="<?= base_url('Pinjam/verifikasi/' . $pinjam['id_pinjam']) ?>" class="btn btn-success btn-xs mb2"><i class="glyphicon glyphicon-check"></i></a>
                                    <?php endif; ?>


                                    <?php if ($pinjam['status'] == 'perpanjang') : ?>
                                    <?php else : ?>

                                       <?php if ($pinjam['kelas'] == '' && $pinjam['status'] != 'pandding'): ?>
                                          <a href="#modal-perpanjang<?= $pinjam['id_pinjam'] ?>" data-toggle="modal" class="btn bg-info btn-xs mb2"><i class="glyphicon glyphicon-zoom-in"></i> <small>Perpanjang</small></a>
                                       <?php endif; ?>

                                       <div class="modal fade" id="modal-perpanjang<?= $pinjam['id_pinjam'] ?>">
                                          <div class="modal-dialog modal-sm">
                                             <div class="modal-content" style="border-radius: 5px;">
                                                <div class="modal-body">
                                                   <br>
                                                   <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                                      <i class="fa fa-info-circle text-orange" style="font-size: 5rem;"></i>
                                                      <h4 class="modal-title text-orange"><strong>PEMBERITAHUAN</strong></h4>
                                                      <p class="text-center">Perpanjang waktu peminjaman buku <strong><?= $pinjam['judul_buku'] ?></strong> atas nama <strong><?= $pinjam['nama_anggota'] ?></strong></p>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                                   <a href="<?= base_url('Pinjam/perpanjang/' . $pinjam['id_pinjam'] . '/' . strtotime($pinjam['tgl_kembali'])) ?>" class="btn btn-sm btn-primary"><small>Ya ! Perpanjang</small></a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    <?php endif; ?>




                                    <a href="#modal-detail<?= $pinjam['id_pinjam'] ?>" data-toggle="modal" class="btn bg-teal btn-xs mb2"><i class="glyphicon glyphicon-zoom-in"></i> </a>
                                    <div class="modal fade" id="modal-detail<?= $pinjam['id_pinjam'] ?>">
                                       <div class="modal-dialog modal-lg">
                                          <div class="modal-content" style="border-radius: 5px;">
                                             <div class="modal-header">
                                                <h4>Detail Peminjaman Buku</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <table>
                                                         <tr>
                                                            <th>Nama Lengkap</th>
                                                            <th class="text-center" width="20"> : </th>
                                                            <th><?= $pinjam['nama_anggota'] ?></th>
                                                         </tr>
                                                         <tr>
                                                            <td>Jenis Kelamin</td>
                                                            <th class="text-center"> : </th>
                                                            <td><?= $pinjam['jk'] == '0' ? 'Laki-laki' : 'Perempuan' ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Nomor Handphone</td>
                                                            <th class="text-center"> : </th>
                                                            <td><?= $pinjam['nohp'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Alamat</td>
                                                            <th class="text-center"> : </th>
                                                            <td><?= $pinjam['alamat'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Status Anggota</td>
                                                            <th class="text-center"> : </th>
                                                            <td><?= $pinjam['status'] == '0' ? 'Guru' : 'Siswa' ?></td>
                                                         </tr>
                                                      </table>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <table>
                                                         <tr>
                                                            <th>Judul Buku</th>
                                                            <th class="text-center" width="20"> : </th>
                                                            <th><?= $pinjam['judul_buku'] ?></th>
                                                         </tr>
                                                         <tr>
                                                            <td>Pengarang</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <td><?= $pinjam['penulis'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Penerbit</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <td><?= $pinjam['penerbit'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Kategori</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <td><?= $pinjam['kategori'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Rak</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <td><?= $pinjam['nama_rak'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Petugas</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <th><?= $pinjam['nama_petugas'] ?></th>
                                                         </tr>
                                                      </table>
                                                   </div>
                                                </div>
                                                <div class="row" style="margin-top: 15px;">
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <div class="info-box new-shadow d-flex align-items-center">
                                                         <span class="info-box-icon bg-white"><i class="fa fa-book text-purple"></i></span>

                                                         <div class="info-box-content ml-0">
                                                            <span class="info-box-text fs-12">Jumlah Buku Dipinjam</span>
                                                            <span class="info-box-number"><?= $pinjam['jumlah_pinjam'] ?></span>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <div class="info-box new-shadow d-flex align-items-center">
                                                         <span class="info-box-icon bg-white"><i class="fa fa-calendar-times-o text-maroon"></i></span>

                                                         <div class="info-box-content ml-0">
                                                            <span class="info-box-text fs-12">Deadline</span>
                                                            <?php
                                                            $tanggal_sekarang = new DateTime(date("Y-m-d"));
                                                            $tanggal_pinjam = new DateTime($pinjam['tgl_pinjam']);
                                                            $tanggal_jatuh_tempo = new DateTime($pinjam['tgl_kembali']);
                                                            $selisih = $tanggal_sekarang->diff($tanggal_jatuh_tempo);
                                                            // var_dump($selisih->days);
                                                            if ($tanggal_sekarang > $tanggal_jatuh_tempo) {
                                                               echo '<span class="info-box-number"><small>Terlambat </small>' . $selisih->days . '<small> Hari</small></span>';
                                                            } else {
                                                               echo '<span class="info-box-number">' . $selisih->days . '<small> Hari lagi</small></span>';
                                                            }
                                                            ?>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row" style="margin-top: 15px;">
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <div class="info-box new-shadow d-flex align-items-center">
                                                         <span class="info-box-icon bg-white"><i class="fa  fa-calendar-check-o text-orange"></i></span>
                                                         <div class="info-box-content ml-0">
                                                            <span class="info-box-text fs-12">Waktu Pinjam</span>
                                                            <span class="info-box-number"><small><?= date("d/m/Y", strtotime($pinjam['tgl_pinjam'])) ?></small></span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <div class="info-box new-shadow d-flex align-items-center">
                                                         <span class="info-box-icon bg-white"><i class="fa fa-calendar-times-o text-navy"></i></span>
                                                         <div class="info-box-content ml-0">
                                                            <span class="info-box-text fs-12">Batas Waktu Pengembalian</span>
                                                            <span class="info-box-number"><small><?= date("d/m/Y", strtotime($pinjam['tgl_kembali'])) ?></small></span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-block btn-default" data-dismiss="modal">TUTUP</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- <a href="#" class="btn btn-xs bg-orange mb2"><i class="glyphicon glyphicon-pencil"></i> <small>UBAH</small></a> -->
                                    <?php if ($pinjam['status'] == 'pandding'): ?>
                                       <a href="#modal-hapus<?= $pinjam['id_pinjam'] ?>" data-toggle="modal" class="btn btn-xs bg-maroon mb2"><i class="glyphicon glyphicon-trash"></i> </a>
                                    <?php endif; ?>
                                    <div class="modal fade" id="modal-hapus<?= $pinjam['id_pinjam'] ?>">
                                       <div class="modal-dialog modal-sm">
                                          <div class="modal-content" style="border-radius: 5px;">
                                             <div class="modal-body">
                                                <br>
                                                <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                                   <i class="fa fa-warning text-orange" style="font-size: 5rem;"></i>
                                                   <h4 class="modal-title text-orange"><strong>PERINGATAN</strong></h4>
                                                   <p class="text-center">Anda akan menghapus data Peminjaman </p>
                                                   <p>Nama Peminjam<strong> : <?= $pinjam['nama_anggota'] ?></strong></p>
                                                   <p>Judul Buku<strong> : <?= $pinjam['judul_buku'] ?></strong></p>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                                <a href="<?= base_url('Peminjaman/delete/' . $pinjam['id_pinjam'] . '/' . $pinjam['kd_buku'] . '/' . $pinjam['jumlah_pinjam']) ?>" class="btn btn-sm btn-primary"><small>Ya ! Hapus</small></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>

                        <!-- </tbody> -->
                     </table>
                  </div>
               </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="settings">
               <div class="row">
                  <div class="col-lg-12 ">
                     <!-- <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div> -->
                     <div class="alert alert-info alert-custom">
                        <ul>
                           <li style="list-style: none; display:flex;align-items: center; margin-left: -25px; font-size: 15px;"><i class="fa fa-info-circle" style="font-size: 25px;"></i> &nbsp;INFORMASI</li>
                           <li> Perpanjang peminjaman hanya bisa dilakukan satu kali</li>
                           <li> Masa lama perpanjang peminjaman 1 minggu / 7 hari</li>
                        </ul>
                     </div>

                     <table class="table" id="peminjaman">
                        <thead>
                           <tr>
                              <th>Anggota</th>
                              <th>Buku</th>
                              <th>Tgl Pinjam</th>
                              <th>Tenggat</th>
                              <th>Jumlah Pinjam</th>
                              <th>Kelas</th>
                              <th>Status</th>
                              <th>#</th>
                           </tr>
                        </thead>
                        <!-- <tbody> -->
                        <tbody>
                           <?php $this->session->set_flashdata('kembali', 'Pinjam') ?>
                           <?php foreach ($peminjamanKelas as  $pinjam) : ?>
                              <tr>
                                 <td>
                                    <a href="<?= base_url('Anggota/detail/' . $pinjam['pj1']) ?>"><?= $pinjam['nama_anggota'] ?></a>
                                 </td>
                                 <td>
                                    <a href="<?= base_url('Buku/detail/' . $pinjam['kd_buku']) ?>"> <?= character_limiter($pinjam['judul_buku'], 70); ?></a>
                                 </td>
                                 <td>
                                    <?= date("d/m/Y - H:i:s", strtotime($pinjam['tgl_pinjam'])) ?>
                                 </td>
                                 <td>
                                    <?= date("d/m/Y - H:i:s", strtotime($pinjam['tgl_kembali'])) ?>
                                 </td>
                                 <td class="text-center"><?= $pinjam['jumlah_pinjam'] ?></td>
                                 <td class="text-center"><?= $pinjam['kelas']  ?></td>
                                 <td class="text-center">Status</td>
                                 <td>
                                    <?php if ($pinjam['status'] != 'dipinjam'): ?>
                                       <a href="#" class="btn btn-success btn-xs mb2"><i class="glyphicon glyphicon-check"></i></a>
                                    <?php endif; ?>

                                    <a href="#modal-detail<?= $pinjam['id_pinjam'] ?>" data-toggle="modal" class="btn bg-teal btn-xs mb2"><i class="glyphicon glyphicon-zoom-in"></i> </a>
                                    <div class="modal fade" id="modal-detail<?= $pinjam['id_pinjam'] ?>">
                                       <div class="modal-dialog modal-lg">
                                          <div class="modal-content" style="border-radius: 5px;">
                                             <div class="modal-header">
                                                <h4>Detail Peminjaman Buku</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row">
                                                   <div class="col-lg-6">
                                                      <table>
                                                         <tr>
                                                            <th>Nama Lengkap</th>
                                                            <th class="text-center" width="20"> : </th>
                                                            <th><?= $pinjam['nama_anggota'] ?></th>
                                                         </tr>
                                                         <tr>
                                                            <td>Jenis Kelamin</td>
                                                            <th class="text-center"> : </th>
                                                            <td><?= $pinjam['jk'] == '0' ? 'Laki-laki' : 'Perempuan' ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Nomor Handphone</td>
                                                            <th class="text-center"> : </th>
                                                            <td><?= $pinjam['nohp'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Alamat</td>
                                                            <th class="text-center"> : </th>
                                                            <td><?= $pinjam['alamat'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Status Anggota</td>
                                                            <th class="text-center"> : </th>
                                                            <td><?= $pinjam['status'] == '0' ? 'Guru' : 'Siswa' ?></td>
                                                         </tr>
                                                      </table>
                                                   </div>
                                                   <div class="col-lg-6">
                                                      <table>
                                                         <tr>
                                                            <th>Judul Buku</th>
                                                            <th class="text-center" width="20"> : </th>
                                                            <th><?= $pinjam['judul_buku'] ?></th>
                                                         </tr>
                                                         <tr>
                                                            <td>Pengarang</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <td><?= $pinjam['penulis'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Penerbit</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <td><?= $pinjam['penerbit'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Kategori</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <td><?= $pinjam['kategori'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Rak</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <td><?= $pinjam['nama_rak'] ?></td>
                                                         </tr>
                                                         <tr>
                                                            <td>Petugas</td>
                                                            <th class="text-center" width="20"> : </th>
                                                            <th><?= $pinjam['nama_petugas'] ?></th>
                                                         </tr>
                                                      </table>
                                                   </div>
                                                </div>
                                                <div class="row" style="margin-top: 15px;">
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <div class="info-box new-shadow d-flex align-items-center">
                                                         <span class="info-box-icon bg-white"><i class="fa fa-book text-purple"></i></span>

                                                         <div class="info-box-content ml-0">
                                                            <span class="info-box-text fs-12">Jumlah Buku Dipinjam</span>
                                                            <span class="info-box-number"><?= $pinjam['jumlah_pinjam'] ?></span>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <div class="info-box new-shadow d-flex align-items-center">
                                                         <span class="info-box-icon bg-white"><i class="fa fa-calendar-times-o text-maroon"></i></span>

                                                         <div class="info-box-content ml-0">
                                                            <span class="info-box-text fs-12">Deadline</span>
                                                            <?php
                                                            $tanggal_sekarang = new DateTime(date("Y-m-d"));
                                                            $tanggal_pinjam = new DateTime($pinjam['tgl_pinjam']);
                                                            $tanggal_jatuh_tempo = new DateTime($pinjam['tgl_kembali']);
                                                            $selisih = $tanggal_sekarang->diff($tanggal_jatuh_tempo);
                                                            // var_dump($selisih->days);
                                                            if ($tanggal_sekarang > $tanggal_jatuh_tempo) {
                                                               echo '<span class="info-box-number"><small>Terlambat </small>' . $selisih->days . '<small> Hari</small></span>';
                                                            } else {
                                                               echo '<span class="info-box-number">' . $selisih->days . '<small> Hari lagi</small></span>';
                                                            }
                                                            ?>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row" style="margin-top: 15px;">
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <div class="info-box new-shadow d-flex align-items-center">
                                                         <span class="info-box-icon bg-white"><i class="fa  fa-calendar-check-o text-orange"></i></span>
                                                         <div class="info-box-content ml-0">
                                                            <span class="info-box-text fs-12">Waktu Pinjam</span>
                                                            <span class="info-box-number"><small><?= date("d/m/Y", strtotime($pinjam['tgl_pinjam'])) ?></small></span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <div class="info-box new-shadow d-flex align-items-center">
                                                         <span class="info-box-icon bg-white"><i class="fa fa-calendar-times-o text-navy"></i></span>
                                                         <div class="info-box-content ml-0">
                                                            <span class="info-box-text fs-12">Batas Waktu Pengembalian</span>
                                                            <span class="info-box-number"><small><?= date("d/m/Y", strtotime($pinjam['tgl_kembali'])) ?></small></span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-block btn-default" data-dismiss="modal">TUTUP</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- <a href="#" class="btn btn-xs bg-orange mb2"><i class="glyphicon glyphicon-pencil"></i> <small>UBAH</small></a> -->
                                    <a href="#modal-hapus<?= $pinjam['id_pinjam'] ?>" data-toggle="modal" class="btn btn-xs bg-maroon mb2"><i class="glyphicon glyphicon-trash"></i> </a>
                                    <div class="modal fade" id="modal-hapus<?= $pinjam['id_pinjam'] ?>">
                                       <div class="modal-dialog modal-sm">
                                          <div class="modal-content" style="border-radius: 5px;">
                                             <div class="modal-body">
                                                <br>
                                                <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                                   <i class="fa fa-warning text-orange" style="font-size: 5rem;"></i>
                                                   <h4 class="modal-title text-orange"><strong>PERINGATAN</strong></h4>
                                                   <p class="text-center">Anda akan menghapus data Peminjaman </p>
                                                   <p>Nama Peminjam<strong> : <?= $pinjam['nama_anggota'] ?></strong></p>
                                                   <p>Judul Buku<strong> : <?= $pinjam['judul_buku'] ?></strong></p>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                                <a href="<?= base_url('Peminjaman/delete/' . $pinjam['id_pinjam'] . '/' . $pinjam['kd_buku'] . '/' . $pinjam['jumlah_pinjam']) ?>" class="btn btn-sm btn-primary"><small>Ya ! Hapus</small></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>

                        <!-- </tbody> -->
                     </table>
                  </div>
               </div>
            </div>
            <!-- /.tab-pane -->
         </div>
         <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
   </div>
</div>