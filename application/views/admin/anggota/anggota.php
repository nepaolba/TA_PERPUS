<div class="row">
   <section class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" , data-class="<?= $this->session->flashdata('class') ?>"></div>
         <div class="box-body">
            <a href="<?= base_url('Anggota/add') ?>" class="btn btn-sm bg-aqua"><i class="fa fa-plus-circle"></i> TAMBAH ANGGOTA BARU</a>
            <br><br>
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>ID Anggota</th>
                     <th>Nama Anggota</th>
                     <th>Status</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($data as $anggota) : ?>
                     <tr>
                        <td><?= $anggota['kd_anggota'] ?></td>
                        <td><?= $anggota['nama_anggota'] ?></td>
                        <td><?= $anggota['status_anggota'] == 0 ? "Guru" : "Siswa" ?></td>
                        <td>
                           <a href="<?= base_url('Anggota/detail/' . $anggota['kd_anggota']) ?>" class="btn btn-xs bg-teal"> <i class="glyphicon glyphicon-zoom-in"></i><small> DETAIL</small></a>
                           <a href="<?= base_url('Anggota/update/' . $anggota['kd_anggota']) ?>" class="btn btn-xs bg-orange"> <i class="glyphicon glyphicon-pencil"></i><small> UBAH</small></a>
                           <a href="#modal<?= $anggota['kd_anggota'] ?>" data-toggle="modal" class="btn btn-xs bg-maroon"><i class="glyphicon glyphicon-trash"></i><small> HAPUS</small></a>
                           <div class="modal fade" id="modal<?= $anggota['kd_anggota'] ?>">
                              <div class="modal-dialog modal-sm">
                                 <div class="modal-content" style="border-radius: 5px;">
                                    <div class="modal-body">
                                       <br>
                                       <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                          <i class="fa fa-warning text-orange" style="font-size: 5rem;"></i>
                                          <h4 class="modal-title text-orange"><strong>PERINGATAN</strong></h4>
                                          <p class="text-center">Anda akan menghapus data anggota <strong><?= $anggota['nama_anggota'] ?></strong> secara permanen</p>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                       <a href="<?= base_url('Anggota/delete/' . $anggota['kd_anggota']) ?>" class="btn btn-sm btn-primary"><small>Ya ! Hapus</small></a>
                                    </div>
                                 </div>   
                              </div>
                           </div>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
               <tfoot>
                  <tr>
                     <th>ID Anggota</th>
                     <th>Nama Anggota</th>
                     <th>Status</th>
                     <th>Aksi</th>
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
   </section>
</div>