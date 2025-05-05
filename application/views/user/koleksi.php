<div class="col-lg-12">
    <div class="article article-style-c">
        <form method="get" action="<?= base_url('Welcome/koleksi') ?>">
            <div class="row">
                <div class="col-lg-10">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari judul / pengarang / penerbit" value="<?= $this->input->get('keyword') ?>">
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php foreach ($data_buku as $buku): ?>
    <a href="<?= base_url('Welcome/detailkoleksi/' . $buku['kd_buku']) ?>">
        <div class="col-12 col-md-4 col-lg-3">
            <article class="article article-style-c">
                <div class="article-header">
                    <div class="article-image" data-background="<?= base_url() ?>assets/dist/img/buku/<?= $buku['foto'] ?>">
                    </div>
                </div>
                <div class="article-details">
                    <div class="article-title">
                        <h2 style="line-height: 1.2px;"><a href="#" style="font-size: 12px;line-height: 1.2;"><?= $buku['judul_buku'] ?></a></h2>
                    </div>
                    <div class="article-user">
                        <img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-1.png" style="width:25px">
                        <div class="article-user-details">
                            <div class="user-detail-name">
                                <a href="#" style="font-size: 12px;"><?= $buku['penulis'] ?></a>
                            </div>
                            <ul class="text-job" style="line-height: 1.2;">
                                <?= $buku['penerbit'] ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </a>
<?php endforeach; ?>