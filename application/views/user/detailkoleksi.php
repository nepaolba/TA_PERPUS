<a href="">
    <div class="col-12 col-md-4 col-lg-4">
        <article class="article article-style-c">
            <div class="article-header">
                <div class="article-image" data-background="<?= base_url() ?>assets/dist/img/buku/<?= $buku->foto ?>">
                </div>
            </div>
            <div class="article-details">

                <div class="article-title">
                    <h3><a href="#"><?= $buku->judul_buku ?></a></h3>
                    <p><?= $buku->penulis ?></p>
                </div>
                <table style="width: 100%;">
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td><?= $buku->kategori ?></td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td><?= $buku->penerbit ?></td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td><?= $buku->tahun_terbit ?></td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>:</td>
                        <td><?= $buku->isbn ?></td>
                    </tr>

                </table>
                <div class="row">
                    <div class="col-lg-12 mb-3 mt-3">
                        <a href="#" class="btn btn-outline-info btn-lg btn-block d-flex align-items-center justify-content-center" style="height: 80px;">
                            <span><?= $buku->sisa_stok ?><br>Stok Buku</span>
                        </a>
                    </div>
                    <!-- <div class="col-lg-6 mb-3 mt-3">
                        <a href="#" class="btn btn-outline-info btn-lg btn-block d-flex align-items-center justify-content-center" style="height: 80px;">
                            <span>0 <br>Antri</span>
                        </a>
                    </div> -->

                </div>
                <form action="<?= base_url('Pinjam/tambahPeminjaman') ?>" method="post">
                    <input type="hidden" name="valid" value="valid">
                    <input type="hidden" value="individu" name="jenis">
                    <input type="hidden" value="<?= $this->session->userdata('id') ?>" name="pilih-anggota">
                    <input type="hidden" value="<?= $buku->kd_buku ?>" name="judul-buku">
                    <input type="hidden" value="<?= date("Y-m-d") ?>" name="jatu_tempo">
                    <button type="submit" class="btn btn-success btn-block mr-1">
                        Pinjam Sekarang
                    </button>
                </form>

            </div>
        </article>
    </div>
</a>

<div class="col-12 col-md-12 col-lg-8">
    <div class="card">




        <div class="card-body">
            <div class="card-header">
                <h4>Detail Buku Buku</h4>
            </div>
            <div class="row">
                <table style="width: 100%;" class="">
                    <tr>
                        <th width="20%">Judul</th>
                        <th width="40"> : </th>
                        <th><?= $buku->judul_buku ?></th>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <th width="40"> : </th>
                        <td><?= $buku->penulis ?></td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <th width="40"> : </th>
                        <td><?= $buku->penerbit ?></td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <th width="40"> : </th>
                        <td><?= $buku->isbn == '' ? '-' : $buku->isbn ?></td>
                    </tr>
                    <tr>
                        <td>Tahun terbit</td>
                        <th width="40"> : </th>
                        <td><?= $buku->tahun_terbit ?></td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <th width="40"> : </th>
                        <td><?= $buku->kategori ?></td>
                    </tr>
                    <tr>
                        <td>Rak</td>
                        <th width="40"> : </th>
                        <td><?= $buku->nama_rak ?></td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <th width="40"> : </th>
                        <td><?= $buku->jumlah_buku ?></td>
                    </tr>
                    <tr>
                        <td>Dipinjam</td>
                        <th width="40"> : </th>
                        <td><?= $buku->jumlah_dipinjam ?></td>
                    </tr>
                    <tr>
                        <td>Sisa Stok</td>
                        <th width="40"> : </th>
                        <td><?= $buku->sisa_stok ?></td>
                    </tr>
                    <tr>
                        <td>Sinopsis</td>
                        <th width="40"> : </th>
                        <td>
                            <?= $buku->sinopsis ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-header">
                <h4>Rekomendasi Buku</h4>
            </div>
            <div class="row">
                <?php foreach ($rekomendasibuku as $key => $rekbuku) : ?>
                    <?php if ($buku->kd_buku != $rekbuku->kd_buku): ?>
                        <div class="col-12 col-md-3 col-lg-3">
                            <a href="<?= base_url('Welcome/detailkoleksi/' . $rekbuku->kd_buku) ?>">
                                <article class="article article-style-c">
                                    <div class="article-header">
                                        <div class="article-image" data-background="<?= base_url() ?>assets/dist/img/buku/<?= $rekbuku->foto ?>">
                                        </div>
                                    </div>
                                </article>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>