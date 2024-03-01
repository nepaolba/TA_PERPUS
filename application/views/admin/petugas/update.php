<style>
   .checkbox label,
   .radio label {
      padding-left: 0;
   }
</style>
<div class="row">
   <div class="col-lg-3">
      <div class="box box-solid new-shadow">
         <div class="box-body " id="imagePreview">
            <img src="<?= base_url('assets/dist/img/petugas/' . $petugas->foto_petugas) ?>" alt="foto-petugas" width="100%">
         </div>
         <div class="box-footer">
            <button class="btn btn-sm btn-block bg-purple" id="pilih-foto">Pilih Foto</button>
         </div>
      </div>
   </div>
   <div class="col-lg-9">
      <div class="box box-solid new-shadow">
         <div class="box-body">
            <form id="formUbahPetugas" method="POST" action="<?= base_url('Petugas/update/' . $petugas->kd_petugas) ?>" enctype="multipart/form-data">
               <div class="col-lg-12">
                  <input type="file" id="fotoPetugas" name="foto_petugas" style="display: none;">
                  <div class="form-group">
                     <label for="namaPetugas">Nama Petugas:</label>
                     <input type="text" class="form-control" id="namaPetugas" name="nama_petugas" value="<?= set_value('nama_petugas', $petugas->nama_petugas) ?>">
                     <?= form_error('nama_petugas', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                  </div>
                  <div class="form-group">
                     <label>Jenis Kelamin:</label>
                     <div class="radio">
                        <label>
                           <input type="radio" name="jk_petugas" value="0" class="flat-red" <?= (set_value('jk_petugas', $petugas->jk_petugas) == '0') ? 'checked' : ''; ?>> Laki-laki
                        </label>
                     </div>
                     <div class="radio">
                        <label>
                           <input type="radio" name="jk_petugas" value="1" class="flat-red" <?= (set_value('jk_petugas', $petugas->jk_petugas) == '1') ? 'checked' : ''; ?>> Perempuan
                        </label>
                     </div>
                     <?= form_error('jk_petugas', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                  </div>
                  <div class="form-group">
                     <label for="alamat">Alamat:</label>
                     <textarea class="form-control" id="alamat" name="alamat_petugas" rows="3"><?= set_value('alamat_petugas', $petugas->alamat_petugas) ?></textarea>
                     <?= form_error('alamat_petugas', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                  </div>
                  <div class="form-group">
                     <label for="noHP">No HP:</label>
                     <input type="text" class="form-control" id="noHP" name="nohp_petugas" value="<?= set_value('nohp_petugas', $petugas->nohp_petugas) ?>">
                     <?= form_error('nohp_petugas', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                  </div>

                  <button type="submit" class="btn btn-sm bg-purple"> SIMPAN DATA</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>