<!-- <div class="row">

   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <h3>CARI ANGGOTA</h3>
         </div>
         <form id="frm-cari-anggota">
            <div class="box-body">
               <div class="form-group">
                  <input type="text" class="form-control" name="kd_anggota" placeholder="Cari berdasarkan NIS/NIP/ID">
               </div>
            </div>
            <div class="box-footer">
               <button class="btn btn-primary btn-sm btn-cari-anggota">CARI ANGGOTA</button>
            </div>
         </form>
      </div>
   </div>

   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <h3>HASIL PENCARIAN ANGGOTA</h3>
         </div>
         <div class="box-body box-pencarian"></div>
      </div>
   </div>

</div> -->






<div class="row">
   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header text-center">
            <span class=""> <i class="fa fa-calendar"></i> Tanggal : <?= date('d/m/Y') ?> </span>
         </div>
         <div class="box-body d-flex justify-content-center">
            <div class="col-lg-6">
               <div class="form-group">
                  <div class="form-group d-flex justify-content-between">
                     <label for="individu">
                        <input type="radio" name="jenisPinjam" class="flat-red" id="individu" checked>
                        INDIVIDU
                     </label>
                     <label for="kelompok">
                        <input type="radio" name="jenisPinjam" class="flat-red" id="kelompok">
                        KELOMPOK
                     </label>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-6">
      <div class="box box-solid new-shadow">
         <form action="<?= base_url('Peminjaman/submitPinjam') ?>" id="addPinjam" method="post">
            <div class="box-body">
               <div class="row">
                  <div class="col-lg-12 " id="input-box"></div>
               </div>
            </div>
            <div class="box-footer " id="box-footer">
               <button type="submit" class="btn btn-block bg-aqua" id="btn-add"><i class="fa fa-check"></i> <small>AJUKAN PEMINJAMAN</small></button>
            </div>
         </form>
      </div>
   </div>
   <div class="col-lg-6 ">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <h4 class="box-title">Detail Anggota</h4>
         </div>
         <div class="box-body">
            <table class="detail-anggota" data-img="<?= base_url('assets/dist/img/buku/') ?>">
            </table>
         </div>
      </div>
   </div>
   <div class="col-lg-6 pull-right">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <h4 class="box-title">Informasi Buku</h4>
         </div>
         <div class="box-body">
            <table class="detail-book" data-img="<?= base_url('assets/dist/img/buku/') ?>">

            </table>
         </div>
      </div>
   </div>
</div>