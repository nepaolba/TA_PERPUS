<div class="row">
   <div class="col-md-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <div class="alert bg-info">
               <h4><i class="icon fa fa-info-circle"></i>PEMBERITAHUAN</h4>
               <ul>
                  <li>NIP/NIS/Username akan digunakan sebagai password </li>
                  <li>Jika Anggota tidak mempunyai NIP/NIS maka silahkan membuat karakter yg unik dengan menggabungkan angka dan huruf untuk menggantikan NIP/NIS</li>
               </ul>
            </div>
         </div>
         <form role="form" method="post" action="<?= base_url('Anggota/add') ?>">
            <div class="box-body">
               <div class="form-group <?= form_error('status') ? 'has-error' : '' ?>">
                  <label>Status</label>
                  <select class="form-control" name="status_anggota">
                     <option value="">Pilih Jenis Anggota</option>
                     <option value="0" <?= set_select('status_anggota', '0'); ?>>Guru</option>
                     <option value="1" <?= set_select('status_anggota', '1'); ?>>Siswa</option>
                  </select>
                  <?= form_error('status', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
               <div class="form-group <?= form_error('kd_anggota') ? 'has-error' : '' ?>">
                  <label for="kd_anggota">NIP/NIS/NIPPPK/Username</label>
                  <input type="text" name="kd_anggota" class="form-control" id="kd_anggota" value="<?= set_value('kd_anggota') ?>" placeholder="Masukan NIP/NIS/NIPPPK/USERNAME">
                  <?= form_error('kd_anggota', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
               <div class="form-group <?= form_error('nama') ? 'has-error' : '' ?>">
                  <label for="nama">Nama Lengkap Anggota</label>
                  <input type="text" class="form-control" name="nama_anggota" value="<?= set_value('nama_anggota') ?>" id="nama" placeholder="Masukan Nama Lengkap Anggota">
                  <?= form_error('nama_anggota', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
               <div class="form-group <?= form_error('jk') ? 'has-error' : '' ?>">
                  <label for="laki">
                     <input type="radio" name="jk" id="laki" class="flat-red" value="0" <?= (set_value('jk') == '0') ? 'checked' : ''; ?>>
                     Laki-Laki
                  </label>&nbsp;&nbsp;
                  <label for="wanita">
                     <input type="radio" id="wanita" name="jk" class="flat-red" value="1" <?= (set_value('jk') == '1') ? 'checked' : ''; ?>>
                     Perempuan
                  </label>
                  <?= form_error('jk', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>

               </div>
               <div class="form-group <?= form_error('alamat') ? 'has-error' : '' ?>">
                  <label for="alamat">Alamat</label>
                  <textarea class="form-control" name="alamat" rows="alamat" id="alamat" placeholder="Masukan alamat ..."><?= set_value('alamat') ?></textarea>
                  <?= form_error('alamat', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
               <div class="form-group <?= form_error('nohp') ? 'has-error' : '' ?>">
                  <label for="nohp">Nomor <i>Handphone</i> (HP)</label>
                  <input type="text" class="form-control" id="nohp" value="<?= set_value('nohp') ?>" name="nohp" data-inputmask="'mask': ['089999999999']" data-mask>
                  <?= form_error('nohp', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
               </div>
            </div>
            <div class="box-footer">
               <a href="<?= base_url('Anggota') ?>" class="btn btn-default"> <i class="fa fa-angle-double-left"></i> KEMBALI</a>
               <button type="submit" class="btn bg-aqua"> <i class="glyphicon glyphicon-floppy-save"></i> SIMPAN DATA</button>
            </div>
         </form>
      </div>
   </div>
</div>