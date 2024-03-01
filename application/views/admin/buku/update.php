<div class="row">
   <div class="col-lg-3">
      <div class="box box-solid new-shadow">
         <div class="box-body" id="imagePreview">
            <img src="<?= base_url('assets/dist/img/buku/' . $bookData['foto']) ?>" alt="gambar-buku" width="100%">
         </div>
         <div class="box-footer">
            <button type="button" class="btn btn-sm btn-block bg-aqua" id="pilih-foto"> PILIH FOTO</button>
         </div>
      </div>
   </div>
   <div class="col-lg-9">
      <div class="box box-solid new-shadow">
         <form id="formBuku" action="<?= base_url('Buku/simpanUbahDataBuku/' . $bookData['kd_buku']) ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
               <input type="file" id="fotoBuku" name="foto" style="display: none;">
               <!-- <input type="text" id="fotoBuku" name="sisa_stok" value="<?= $bookData['sisa_stok'] ?>" style="display: none;"> -->
               <div class="form-group">
                  <label for="judul_buku">Judul Buku</label>
                  <input type="text" name="judul_buku" id="judul_buku" value="<?= set_value('judul_buku', $bookData['judul_buku']) ?>" class="form-control" placeholder="Masukan Judul Buku">
                  <?= form_error('judul_buku', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="penulis">Pengarang</label>
                        <input type="text" name="penulis" id="penulis" value="<?= set_value('penulis', $bookData['penulis']) ?>" class="form-control" placeholder="Masukan Penulis ">
                        <?= form_error('penulis', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="isbn">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" value="<?= set_value('penerbit', $bookData['penerbit']) ?>" class="form-control" placeholder="Masukan penerbit">
                        <?= form_error('penerbit', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" id="isbn" value="<?= set_value('isbn', $bookData['isbn']) ?>" class="form-control" placeholder="Masukan ISBN">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="text" name="tahun_terbit" value="<?= set_value('tahun_terbit', $bookData['tahun_terbit']) ?>" id="tahun_terbit" class="form-control" placeholder="Masukan tahun terbit">
                        <?= form_error('tahun_terbit', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
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
                              <option value="<?= $rack['id_rak'] ?>" <?= ($rack['id_rak'] == $bookData['id_rak']) ? 'selected' : ''; ?>><?= $rack['nama_rak'] ?></option>
                           <?php endforeach; ?>
                        </select>
                        <?= form_error('id_rak', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="kd_kategori">Kategori Buku</label>
                        <select name="kd_kategori" id="kd_kategori" class="form-control select2" style="width: 100%;">
                           <option value="">Pilih Kategori Buku</option>
                           <?php foreach ($category as $category) : ?>
                              <option value="<?= $category['kd_kategori'] ?>" <?= ($bookData['kd_kategori'] == $category['kd_kategori']) ? 'selected' : ''; ?>><?= $category['kategori'] ?></option>
                           <?php endforeach; ?>
                        </select>
                        <?= form_error('kd_kategori', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="jumlah_buku">Jumlah Buku</label>
                  <input type="text" name="jumlah_buku" id="jumlah_buku" value="<?= set_value('jumlah_buku', $bookData['jumlah_buku']) ?>" class="form-control" placeholder="Masukan Jumlah Buku">
                  <?= form_error('jumlah_buku', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
            </div>
            <div class="box-footer">
               <a href="<?= base_url('Buku') ?>" class="btn btn-default"> <i class="fa fa-angle-double-left"></i> Kembali</a>
               <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Simpan data</button>
            </div>
         </form>
      </div>
   </div>
</div>