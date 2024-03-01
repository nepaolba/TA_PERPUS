<div class="row">
   <div class="col-lg-5">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <h4 class="box-title">TAMBAH RAK BUKU</h4>
         </div>
         <form method="post" action="<?= base_url('Rak/add') ?>">
            <div class="box-body">
               <div class="form-group">
                  <label for="kategori">NAMA RAK</label>
                  <input type="text" name="nama_rak" id="kategori" class="form-control">
                  <?= form_error('nama_rak', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-block btn-sm bg-aqua"><i class="glyphicon glyphicon-floppy-save"></i> SIMPAN RAK BUKU</button>
            </div>
         </form>
      </div>
   </div>
   <div class="col-lg-7">
      <div class="box box-solid new-shadow">
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
                  <?php foreach ($rak as $rak) : ?>
                     <tr>
                        <td><?= $rak['nama_rak'] ?></td>
                        <td>
                           <a href="#modal-edit<?= $rak['id_rak'] ?>" data-id="<?= $rak['id_rak'] ?>" data-toggle="modal" class="btn btn-xs bg-orange btn-edit"><i class="glyphicon glyphicon-pencil"></i> <small>UBAH</small></a>

                           <div class="modal fade" id="modal-edit<?= $rak['id_rak'] ?>">
                              <div class="modal-dialog modal-sm">
                                 <div class="modal-content" style="border-radius: 5px;">
                                    <div class="modal-header">
                                       <h4 class="modal-tittle">Ubah Rak Buku</h4>
                                    </div>
                                    <form role="form" id="frm-edit<?= $rak['id_rak'] ?>" method="post" action="<?= base_url('Rak/update/' . $rak['id_rak']) ?>">
                                       <div class="modal-body">
                                          <div class="form-group fg<?= $rak['id_rak'] ?>" style="display: flex; flex-direction:column ">
                                             <label for="kategori">Nama Rak</label>
                                             <input type="text" name="nama_rak" value="<?= $rak['nama_rak'] ?>" id="kategori<?= $rak['id_rak'] ?>" class="form-control">
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
                           <a href="#modal-hapus<?= $rak['id_rak'] ?>" data-toggle="modal" class="btn btn-xs bg-maroon"><i class="glyphicon glyphicon-trash"></i> <small>HAPUS</small></a>
                           <div class="modal fade" id="modal-hapus<?= $rak['id_rak'] ?>">
                              <div class="modal-dialog modal-sm">
                                 <div class="modal-content" style="border-radius: 5px;">
                                    <div class="modal-body">
                                       <br>
                                       <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                          <i class="fa fa-warning text-orange" style="font-size: 5rem;"></i>
                                          <h4 class="modal-title text-orange"><strong>PERINGATAN</strong></h4>
                                          <p class="text-center">Anda akan menghapus kategori bukju <strong><?= $rak['nama_rak'] ?></strong> secara permanen dan data buku yang berkaitan dengan kategori ini akan ikut terhapus</p>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                       <a href="<?= base_url('Rak/delete/' . $rak['id_rak']) ?>" class="btn btn-sm btn-primary"><small>Ya ! Hapus</small></a>
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