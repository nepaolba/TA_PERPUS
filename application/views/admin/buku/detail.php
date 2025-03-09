<div class="row">
   <div class="col-lg-12">
      <?php $link = $this->session->flashdata('kembali');  ?>
      <a href="<?= base_url($link ? $link : 'Buku') ?>" class="btn btn-sm bg-orange">KEMBALI</a>
      <br><br>
   </div>
</div>
<div class="row">
   <div class="col col-lg-3">
      <div class="box box-solid new-shadow">
         <div class="box-body">
            <img src="<?= base_url('assets/dist/img/buku/' . $book->foto) ?>" alt="" width="100%">
         </div>
      </div>
   </div>
   <div class="col col-lg-9">
      <div class="box box-solid new-shadow">
         <div class="box-body">
            <table style="width: 100%;" class="table">
               <tr>
                  <th width="15%">Judul</th>
                  <th width="30"> : </th>
                  <th><?= $book->judul_buku ?></th>
               </tr>
               <tr>
                  <td>Pengarang</td>
                  <th width="30"> : </th>
                  <td><?= $book->penulis ?></td>
               </tr>
               <tr>
                  <td>Penerbit</td>
                  <th width="30"> : </th>
                  <td><?= $book->penerbit ?></td>
               </tr>
               <tr>
                  <td>ISBN</td>
                  <th width="30"> : </th>
                  <td><?= $book->isbn == '' ? '-' : $book->isbn ?></td>
               </tr>
               <tr>
                  <td>Tahun terbit</td>
                  <th width="30"> : </th>
                  <td><?= $book->tahun_terbit ?></td>
               </tr>
               <tr>
                  <td>Kategori</td>
                  <th width="30"> : </th>
                  <td><?= $book->kategori ?></td>
               </tr>
               <tr>
                  <td>Rak</td>
                  <th width="30"> : </th>
                  <td><?= $book->nama_rak ?></td>
               </tr>
               <tr>
                  <td>Stok</td>
                  <th width="30"> : </th>
                  <td><?= $book->jumlah_buku ?></td>
               </tr>
               <tr>
                  <td>Dipinjam</td>
                  <th width="30"> : </th>
                  <td><?= $book->jumlah_dipinjam ?></td>
               </tr>
               <tr>
                  <td>Sisa Stok</td>
                  <th width="30"> : </th>
                  <td><?= $book->sisa_stok ?></td>
               </tr>
               <tr>
                  <td>Sinopsis</td>
                  <th width="30"> : </th>
                  <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est ipsum magnam molestias et. Saepe atque veniam esse, accusamus ipsa, doloremque suscipit, ullam iusto non maxime temporibus asperiores perferendis labore libero.
                     Quia sit culpa iste cumque ullam laboriosam magnam amet repudiandae, praesentium sequi nulla tenetur cum? Odio error nobis, excepturi magni iste itaque numquam laborum quis sint quaerat omnis est voluptatem?0</td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-lg-12">
      <div class="box box-solid new-shadow">
         <div class="box-header">
            <h4 class="box-title">DAFTAR ANGGOTA PEMINJAM BUKU</h4>
         </div>
         <div class="box-body">
            <table class="table">
               <thead>
                  <tr>
                     <!-- <th>No</th> -->
                     <th>Nama Peminjam</th>
                     <th>Tgl Jatu Tempo</th>
                     <th>Total Pinjam</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($peminjam as $key => $value) : ?>
                     <tr>
                        <td>
                           <a href="<?= base_url('Anggota/detail/' . $value->kd_anggota) ?>"> <?= $value->nama_anggota ?></a>
                        </td>
                        <td><?= $value->tgl_kembali ?></td>
                        <td><?= $value->jumlah_pinjam ?></td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
               <tfoot>
                  <tr style="background-color: #00c2ff1f; border-radius:5px">
                     <!-- <th></th> -->
                     <th colspan="2"><strong>TOTAL :</strong></th>
                     <!-- <th></th>
                     <th></th> -->
                     <th><strong><?= $total_pinjam; ?></strong></th>

                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
   </div>
</div>