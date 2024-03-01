<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box new-shadow d-flex align-items-center">
            <span class="info-box-icon bg-white d-flex justify-content-center align-items-center"><i class="ion ion-person-stalker text-purple"></i></span>
            <div class="info-box-content ml-0">
                <span class="info-box-text">ANGGOTA</span>
                <span class="info-box-number"><?= $count_anggota; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box new-shadow d-flex align-items-center">
            <span class="info-box-icon bg-white d-flex justify-content-center align-items-center"><i class="fa fa-book text-teal"></i></span>
            <div class="info-box-content ml-0">
                <span class="info-box-text">BUKU</span>
                <span class="info-box-number"><?= $count_book; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box new-shadow d-flex align-items-center">
            <span class="info-box-icon bg-white d-flex justify-content-center align-items-center"><i class="fa fa-expand text-orange"></i></span>
            <div class="info-box-content ml-0">
                <span class="info-box-text">Peminjaman</span>
                <span class="info-box-number"><?= $count_pinjam; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box new-shadow d-flex align-items-center">
            <span class="info-box-icon bg-white d-flex justify-content-center align-items-center"><i class="fa fa-compress text-maroon"></i></span>
            <div class="info-box-content ml-0">
                <span class="info-box-text">PENGEMBALIAN</span>
                <span class="info-box-number">20 belum</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <section class="col-lg-8 connectedSortable">
        <div class="box box-solid new-shadow">
            <div class="box-header">
                <h3 class="box-title">PROFIL PERPUSTAKAAN</h3>
            </div>
            <div class="box-body">

                <!-- <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="<?= base_url('assets/') ?>dist/img/photo2.png" alt="First slide">
                        </div>
                        <div class="item">
                            <img src="<?= base_url('assets/') ?>dist/img/photo3.jpg" alt="Second slide">
                        </div>
                        <div class="item">
                            <img src="<?= base_url('assets/') ?>dist/img/photo4.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                    </a>
                </div> -->
                <table class="table">
                    <tr>
                        <th>Nama Perpustakaan</th>
                        <th>:</th>
                        <td>PERPUSTAKAAN SMA NEGERI 5 KUPANG</td>
                    </tr>
                    <tr>
                        <th>Status Perpus</th>
                        <th>:</th>
                        <td>ll</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td>ll</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td>ll</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td>ll</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td>ll</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td>ll</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td>ll</td>
                    </tr>

                </table>
            </div>

    </section>
    <section class="col-lg-4">
        <div class="info-box bg-white">
            <span class="info-box-icon bg-teal"><i class="fa fa-list-ul"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Kategori</span>
                <span class="info-box-number"><?= $count_kategori ?></span>
                <div class="progress bg-teal">
                    <div class="progress-bar"></div>
                </div>
                <span class="progress-description">
                    Total Kategori Buku
                </span>
            </div>
        </div>
        <div class="info-box bg-white">
            <span class="info-box-icon bg-purple"><i class="fa fa-database"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Stok Buku</span>
                <span class="info-box-number"><?= $count_stok ?></span>
                <div class="progress bg-purple">
                    <div class="progress-bar"></div>
                </div>
                <span class="progress-description">
                    Total Stok Buku
                </span>
            </div>
        </div>
        <div class="info-box bg-white">
            <span class="info-box-icon bg-orange"><i class="fa fa-folder-open-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Rak Buku</span>
                <span class="info-box-number"><?= $count_rak ?></span>
                <div class="progress bg-orange">
                    <div class="progress-bar"></div>
                </div>
                <span class="progress-description">
                    Total Rak Buku
                </span>
            </div>
        </div>
    </section>
    <section class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-header">
                <h3 class="box-title">Laporan Hari Ini</h3>
                <h6><i class="fa fa-calendar"></i> Tanggal : <?= date('d/m/Y') ?></h6>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 text-center">
                        <h6 class="text-teal"><strong>Anggota Baru</strong></h6>
                        <h5><strong><?= $jumlah_anggota_baru ?></strong></h5>
                    </div>
                    <div class="col-lg-3 text-center">
                        <h6 class="text-aqua"><strong>Peminjaman</strong></h6>
                        <h5><strong><?= $laporan_pinjam ?></strong></h5>
                    </div>
                    <div class="col-lg-3 text-center">
                        <h6 class="text-purple"><strong>Pengembalian</strong></h6>
                        <h5><strong>2 belum ada</strong></h5>
                    </div>
                    <div class="col-lg-3 text-center">
                        <h6 class="text-maroon"><strong>Jatuh Tempo</strong></h6>
                        <h5><strong><?= $jumlah_peminjam_jatuh_tempo ?></strong></h5>
                    </div>
                </div>
            </div>
            <div class="box-footer" style="border-top: none;"></div>

        </div>
    </section>
    <section class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-header">
                <h3 class="box-title">Grafik Transaksi Buku Tahun <?= date('Y') ?></h3>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
                </div>
            </div>

        </div>
    </section>


</div>
<script src="<?= base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>


<script>
    const grafikData = <?php echo json_encode($grafik); ?>;
    const labels = grafikData.map(item => getNamaBulan(item.bulan));
    const peminjamanData = grafikData.map(item => item.jumlah_peminjaman);

    function getNamaBulan($nomor_bulan) {
        const nama_bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        return nama_bulan[$nomor_bulan - 1];
    }
</script>