<div class="row">
   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <a href="<?= base_url('Buku/tambahBuku') ?>" data-toggle="modal" class="btn btn-sm bg-aqua"> <i class="fa fa-plus-circle"></i> TAMBAH BUKU BARU</a>
         </div>
         <div class="box-body">
            <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
            <table id="example2" class="table">
               <thead>
                  <tr>
                     <th>Buku</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>

                  <?php foreach ($data_buku as $book) : ?>
                     <tr>
                        <td>
                           <div class="buku" style="display: flex;">
                              <img src="<?= base_url('assets/dist/img/buku/') . $book['foto'] ?>" class="image-fluid" width="100" height="100" alt="foto buku" style="margin-right:10px">
                              <div class="caption" style="display:flex;flex-direction: column;">
                                 <a class="titel" style="cursor: pointer; font-size:13px "><?= character_limiter($book['judul_buku'], 70); ?></a>
                                 <span class="sub"><strong>Penerbit : </strong><?= $book['penerbit'] ?></span>
                                 <span class="sub"> <strong>Penulis :</strong> <?= $book['penulis'] ?></span>
                                 <span class="sub"> <strong>Stok :</strong> <?= $book['jumlah_buku'] ?></span>
                                 <span class="sub"> <strong>Dipinjam :</strong> <?= $book['jumlah_dipinjam'] ?></span>
                                 <span class="sub"> <strong>Sisa Stok :</strong> <?= $book['sisa_stok']  ?></span>
                              </div>
                           </div>
                        </td>
                        <td>
                           <a href="<?= base_url('Buku/detail/' . $book['kd_buku']) ?>" class="btn btn-xs bg-teal"><i class="glyphicon glyphicon-zoom-in"></i><small> Detail</small></a>
                           <a href="<?= base_url('Buku/update/' . $book['kd_buku']) ?>" class="btn btn-xs bg-orange"><i class="glyphicon glyphicon-pencil"></i><small> Edit</small></a>
                           <a href="#modal-delete<?= $book['kd_buku'] ?>" data-toggle="modal" class="btn btn-xs bg-maroon"><i class="glyphicon glyphicon-trash"></i><small> Hapus</small></a>
                           <div class="modal fade" id="modal-delete<?= $book['kd_buku'] ?>">
                              <div class="modal-dialog modal-sm">
                                 <div class="modal-content" style="border-radius: 5px;">
                                    <div class="modal-body">
                                       <br>
                                       <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                          <i class="fa fa-warning text-orange" style="font-size: 5rem;"></i>
                                          <h4 class="modal-title text-orange"><strong>PERINGATAN</strong></h4>
                                          <p class="text-center">Anda akan menghapus data buku <strong><?= $book['judul_buku'] ?></strong> secara permanen</p>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                       <a href="<?= base_url('Buku/delete/' . $book['kd_buku']) ?>" class="btn btn-sm btn-primary"><small>Ya ! Hapus</small></a>
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