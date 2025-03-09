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
                        <td><?= $buku->kd_kategori ?></td>
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
                    <div class="col-lg-6 mb-3 mt-3">
                        <a href="#" class="btn btn-outline-info btn-lg btn-block d-flex align-items-center justify-content-center" style="height: 80px;">
                            <span>0 <br>Pinjam</span>
                        </a>
                    </div>
                    <div class="col-lg-6 mb-3 mt-3">
                        <a href="#" class="btn btn-outline-info btn-lg btn-block d-flex align-items-center justify-content-center" style="height: 80px;">
                            <span>0 <br>Antri</span>
                        </a>
                    </div>

                </div>
                <a href="#" class="btn btn-success btn-block mr-1">
                    Pinjam
                </a>
            </div>
        </article>
    </div>
</a>

<div class="col-12 col-md-12 col-lg-8">
    <div class="card">
        <div class="card-header">
            <h4>Rekomendasi Buku</h4>
        </div>
        <div class="card-body">
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