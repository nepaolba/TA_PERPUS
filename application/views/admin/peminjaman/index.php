<div class="row">
   <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <a href="<?= base_url('Peminjaman/add') ?>" class="btn btn-sm bg-aqua"><i class="fa fa-plus-circle"></i> PEMINJAMAN BARU</a>
         </div>
         <div class="box-body">
            <table class="table" id="peminjaman">
               <thead>
                  <tr>
                     <th>Nama Peminjam</th>
                     <th>Judul Buku</th>
                     <th>Tgl Pinjam</th>
                     <th>Tenggat</th>
                     <th>Jumlah</th>
                     <th>aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $this->session->set_flashdata('kembali', 'Peminjaman') ?>
                  <?php foreach ($peminjaman as  $pinjam) : ?>
                     <tr>
                        <td>
                           <a href="<?= base_url('Anggota/detail/' . $pinjam['nis_nip']) ?>"><?= $pinjam['nama_anggota'] ?></a>
                           <p>
                              <small><?= $pinjam['kelas'] != '-' ? "Peminjaman Kelas :" . $pinjam['kelas'] : 'Peminjaman Individu'  ?></small>
                           </p>
                        </td>
                        <td>
                           <a href="<?= base_url('Buku/detail/' . $pinjam['kd_buku']) ?>"> <?= character_limiter($pinjam['judul_buku'], 70); ?></a>
                           <p class="small">Pengarang : <?= $pinjam['penulis'] ?></p>
                        </td>
                        <!-- <td><?= $pinjam['judul_buku'] ?></td> -->
                        <td><?= date("d/m/Y", strtotime($pinjam['tgl_pinjam'])) ?></td>
                        <td><?= date("d/m/Y", strtotime($pinjam['tgl_kembali'])) ?></td>
                        <td class="text-center"><?= $pinjam['jumlah_pinjam'] ?></td>
                        <td>
                           <a href="#modal-detail<?= $pinjam['id_pinjam'] ?>" data-toggle="modal" class="btn bg-teal btn-xs mb2"><i class="glyphicon glyphicon-zoom-in"></i> <small>DETAIL</small></a>
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
                                          <div class="col-md-4 col-sm-6 col-xs-12">
                                             <div class="info-box new-shadow d-flex align-items-center">
                                                <span class="info-box-icon bg-white"><i class="fa fa-book text-purple"></i></span>

                                                <div class="info-box-content ml-0">
                                                   <span class="info-box-text fs-12">Jumlah Buku Dipinjam</span>
                                                   <span class="info-box-number"><?= $pinjam['jumlah_pinjam'] ?></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 col-sm-6 col-xs-12">
                                             <div class="info-box new-shadow d-flex align-items-center">
                                                <span class="info-box-icon bg-white"><i class="fa fa-clock-o text-teal"></i></span>

                                                <div class="info-box-content ml-0">
                                                   <span class="info-box-text fs-12">Status</span>
                                                   <span class="info-box-number">90<small>%</small></span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 col-sm-6 col-xs-12">
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
                           <a href="#" class="btn btn-xs bg-orange mb2"><i class="glyphicon glyphicon-pencil"></i> <small>UBAH</small></a>
                           <a href="#modal-hapus<?= $pinjam['id_pinjam'] ?>" data-toggle="modal" class="btn btn-xs bg-maroon mb2"><i class="glyphicon glyphicon-trash"></i> <small>HAPUS</small></a>
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
            </table>
         </div>
      </div>
   </div>
</div>