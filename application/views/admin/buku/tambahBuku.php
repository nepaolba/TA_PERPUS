<div class="row">
   <div class="col-lg-3">
      <div class="box box-solid new-shadow">
         <div class="box-body" id="imagePreview">
            <img src="<?= base_url('assets/dist/img/buku/default.jpg') ?>" width="100%" alt="foto-buku">
         </div>
         <div class="box-footer">
            <button type="button" class="btn btn-sm btn-block bg-aqua" id="pilih-foto"> PILIH FOTO</button>
         </div>
      </div>
   </div>
   <div class="col-lg-9">
      <div class="box box-solid new-shadow">
         <form id="formBuku" action="<?= base_url('Buku/simpanDataBuku') ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
               <input type="file" id="fotoBuku" name="foto" style="display: none;">


               <div class="form-group">
                  <label for="judul_buku">Judul Buku</label>
                  <input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Masukan Judul Buku">
               </div>

               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="penulis">Pengarang</label>
                        <input type="text" name="penulis" id="penulis" class="form-control" placeholder="Masukan Penulis ">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="isbn">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" class="form-control" placeholder="Masukan penerbit">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Masukan ISBN">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control" placeholder="Masukan tahun terbit">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="id_rak">Rak Buku</label>
                        <select name="id_rak" id="id_rak" class="form-control select2" style="width: 100%;">
                           <option value="">Pilih Rak Buku</option>
                           <?php foreach ($rack as $rack) : ?>
                              <option value="<?= $rack['id_rak'] ?>"><?= $rack['nama_rak'] ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="kd_kategori">Kategori Buku</label>
                        <select name="kd_kategori" id="kd_kategori" class="form-control select2" style="width: 100%;">
                           <option value="">Pilih Kategori Buku</option>
                           <?php foreach ($category as $category) : ?>
                              <option value="<?= $category['kd_kategori'] ?>"><?= $category['kategori'] ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="jumlah_buku">Jumlah Buku</label>
                  <input type="text" name="jumlah_buku" id="jumlah_buku" class="form-control" placeholder="Masukan Jumlah Buku">
               </div>
            </div>
            <div class="box-footer">
               <a href="<?= base_url('Buku') ?>" class="btn btn-sm btn-default"> <i class="fa fa-angle-double-left"></i> Kembali</a>
               <button type="submit" class="btn btn-sm bg-aqua"> <i class="fa fa-save"></i> Simpan data</button>
            </div>
         </form>
      </div>
   </div>
</div>