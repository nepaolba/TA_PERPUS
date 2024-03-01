<div class="row">
   <div class="col-md-5">
      <div class="box box-solid">
         <div class="box-header">
            <h4 class="box-title">TAMBAH KATEGORI BUKU</h4>
         </div>
         <form method="post" action="<?= base_url('Kategori/add') ?>">
            <div class="box-body">
               <div class="form-group">
                  <label for="kategori">Nama Kategori</label>
                  <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukan Nama Kategori">
                  <?= form_error('kategori', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-sm bg-aqua btn-block"><i class="glyphicon glyphicon-floppy-save"></i> SIMPAN KATEGORI BUKU</button>
            </div>
         </form>
      </div>
   </div>
   <div class="col-md-7">
      <div class="box box-solid">
         <div class="box-header">
            <h4 class="box-title">DAFTAR KATEGORI BUKU</h4>
         </div>
         <div class="box-body">
            <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" , data-class="<?= $this->session->flashdata('class') ?>"></div>
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Kategori Buku</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($kategori as $ktr) : ?>
                     <tr>
                        <td><?= $ktr['kategori'] ?></td>
                        <td>
                           <a href="#modal-edit<?= $ktr['kd_kategori'] ?>" data-id="<?= $ktr['kd_kategori'] ?>" data-toggle="modal" class="btn btn-xs bg-orange btn-edit"><i class="fa fa-edit"></i> <small>UBAH</small></a>
                           <div class="modal fade" id="modal-edit<?= $ktr['kd_kategori'] ?>">
                              <div class="modal-dialog modal-sm">
                                 <div class="modal-content" style="border-radius: 5px;">
                                    <div class="modal-header">
                                       <h4 class="modal-tittle">Ubah Kategori Buku</h4>
                                    </div>
                                    <form role="form" id="frm-edit<?= $ktr['kd_kategori'] ?>" method="post" action="<?= base_url('Kategori/update/' . $ktr['kd_kategori']) ?>">
                                       <div class="modal-body">
                                          <div class="form-group fg<?= $ktr['kd_kategori'] ?>" style="display: flex; flex-direction:column ">
                                             <label for="kategori">Nama Kategori</label>
                                             <input type="text" name="kategori" value="<?= $ktr['kategori'] ?>" id="kategori<?= $ktr['kd_kategori'] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Tutup</small></button>
                                          <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> <small>Simpan</small></button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <a href="#modal-hapus<?= ($ktr['kd_kategori']) ?>" data-toggle="modal" class="btn btn-xs bg-maroon"><i class="fa fa-trash"></i> <small>HAPUS</small></a>
                           <div class="modal fade" id="modal-hapus<?= $ktr['kd_kategori'] ?>">
                              <div class="modal-dialog modal-sm">
                                 <div class="modal-content" style="border-radius: 5px;">
                                    <div class="modal-body">
                                       <br>
                                       <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                          <i class="fa fa-warning text-orange" style="font-size: 5rem;"></i>
                                          <h4 class="modal-title text-orange"><strong>PERINGATAN</strong></h4>
                                          <p class="text-center">Anda akan menghapus kategori bukju <strong><?= $ktr['kategori'] ?></strong> secara permanen dan data buku yang berkaitan dengan kategori ini akan ikut terhapus</p>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                       <a href="<?= base_url('Kategori/delete/' . $ktr['kd_kategori']) ?>" class="btn btn-sm btn-primary"><small>Ya ! Hapus</small></a>
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