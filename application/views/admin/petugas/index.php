<div class="row">
   <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>

   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <a href="<?= base_url('Petugas/add') ?>" class="btn btn-sm bg-purple">
               <i class="fa fa-plus-circle"></i> TAMBAH PETUGAS
            </a>
         </div>
         <div class="box-body">
            <table class="table" id="table-petugas">
               <thead>
                  <tr>
                     <th>foto</th>
                     <th>Nama Petugas</th>
                     <th>JK</th>
                     <th>Alamat</th>
                     <th>No HP</th>
                     <th>Username</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($petugas as $petugas) : ?>
                     <tr>
                        <th>
                           <img src="<?= base_url('assets/dist/img/petugas/' . $petugas->foto_petugas) ?>" alt="ll" width="40" style="border-radius: 20%;">
                        </th>
                        <td><?= $petugas->nama_petugas ?></td>
                        <td><?= $petugas->jk_petugas == '0' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td><?= $petugas->alamat_petugas ?></td>
                        <td><?= $petugas->nohp_petugas ?></td>
                        <td><?= $petugas->username ?></td>
                        <td>
                           <a href="<?= base_url('Petugas/resetPassword/' . $petugas->kd_petugas) ?>" class="btn btn-xs bg-teal"><i class="glyphicon glyphicon-refresh"></i> <small>Reset Pass</small></a>
                           <a href="<?= base_url('Petugas/update/' . $petugas->kd_petugas) ?>" class="btn btn-xs bg-orange"><i class="glyphicon glyphicon-pencil"></i> <small>UBAH</small></a>
                           <a href="#modal-hapus<?= $petugas->kd_petugas ?>" data-toggle="modal" class="btn btn-xs bg-maroon"><i class="glyphicon glyphicon-trash"></i> <small>HAPUS</small></a>
                           <div class="modal fade" id="modal-hapus<?= $petugas->kd_petugas ?>">
                              <div class="modal-dialog modal-sm">
                                 <div class="modal-content" style="border-radius: 5px;">
                                    <div class="modal-body">
                                       <br>
                                       <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                          <i class="fa fa-warning text-orange" style="font-size: 5rem;"></i>
                                          <h4 class="modal-title text-orange"><strong>PERINGATAN</strong></h4>
                                          <p class="text-center">Anda akan menghapus data Petugas <strong><?= $petugas->nama_petugas ?></strong> secara permanen</p>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                       <a href="<?= base_url('Petugas/delete/' . $petugas->kd_petugas) ?>" class=" btn btn-sm btn-primary"><small>Ya ! Hapus</small></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                     </tr>
                  <?php endforeach ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>