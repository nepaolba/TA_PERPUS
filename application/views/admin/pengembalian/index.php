<div class="row">
   <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <a href="<?= base_url('Pengembalian/individu') ?>" class="btn btn-sm bg-purple"><i class="fa fa-plus-circle"></i> PENGEMBALIAN INDIVIDU</a>
            <a href="<?= base_url('Pengembalian/pengajuan') ?>" class="btn btn-sm bg-purple"><i class="fa fa-plus-circle"></i> PENGEMBALIAN KELAS</a>
         </div>
         <div class="box-body">
            <table class="table" id="example1">
               <thead>
                  <tr>
                     <th>Nama Anggota</th>
                     <th>Judul Buku</th>
                     <th>Jumlah</th>
                     <th>Tgl Pinjam</th>
                     <th>Tenggat</th>
                     <th>Tgl Pengembalian</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($pengembalian as $key => $value) : ?>
                     <tr>
                        <td>
                           <a href=""><?= $value['nama_anggota'] ?></a><br>
                           <?= $value['kelas'] ?>
                        </td>
                        <td>
                           <a href=""><?= $value['judul_buku'] ?></a>
                           <p>Pengarang : <?= $value['penulis'] ?></p>
                        </td>
                        <td><?= $value['jumlah_kembali'] ?></td>
                        <td><?= $value['tgl_pinjam'] ?></td>
                        <td><?= $value['tgl_kembali'] ?></td>
                        <td><?= $value['tgl'] ?></td>
                        <td>
                           <!-- <a href="<?= base_url('Pengembalian/pengajuan/' . $value['id_kembali']) ?>" class="btn btn-info btn-block btn-xs mb2"> <small> AJUKAN PENGEMBALIAN BUKU</small></a> -->
                           <!-- <div class="d-flex justify-content-between"> -->
                           <a href="" class="btn bg-teal btn-xs mb2"><i class="glyphicon glyphicon-zoom-in"></i> <small>DETAIL</small></a>
                           <!-- <a href="" class="btn bg-orange btn-xs mb2"><i class="glyphicon glyphicon-pencil"></i> <small>UBAH</small></a> -->
                           <!-- <a href="" class="btn bg-maroon btn-xs mb2"><i class="glyphicon glyphicon-trash"></i> <small>HAPUS</small></a> -->
                           <!-- </div> -->
                        </td>
                     </tr>
                  <?php endforeach ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>