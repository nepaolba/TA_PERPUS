<!-- File: application/views/peminjaman/bukti_transaksi.php -->
<!-- <section class="section"> -->
<!-- <div class="section-header"> -->
<!-- <h1></h1> -->
<!-- </div> -->
<div class="col col-lg-12">
    <h2 class="section-title">Bukti Transaksi Peminjaman</h2>
    <div class="card">
        <div class="card-header">
            <h4>Informasi Peminjaman</h4>
        </div>
        <div class="card-body">y
            <div class="row">
                <div class="col-md-6">
                    <p><strong>No.Transaksi:</strong> <?= $transaksi->id_pinjam ?></p>
                    <p><strong>Tanggal Peminjaman:</strong> <?= date('d-m-Y', strtotime($transaksi->tgl_pinjam)) ?></p>
                    <p><strong>Tanggal Jatuh Tempo:</strong> <?= date('d-m-Y', strtotime($transaksi->tgl_kembali)) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Nama Peminjam:</strong> <?= $transaksi->nama_anggota ?></p>
                    <p><strong>NIS/NIM:</strong> <?= $transaksi->pj1 ?></p>
                    <p><strong>Jenis Anggota:</strong> <?= ucfirst($transaksi->jenis_anggota) ?></p>
                </div>
            </div>
            <hr>
            <h5>Detail Buku yang Dipinjam</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $transaksi->kd_buku ?></td>
                            <td><?= $transaksi->judul_buku ?></td>
                            <td><?= $transaksi->penulis ?></td>
                            <td><?= $transaksi->jumlah_pinjam ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-info mt-4">
                Harap kembalikan buku tepat waktu. Denda akan dikenakan jika terlambat.
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="<?= site_url('Welcome/daftarPinjam/') ?>" class="btn btn-warning">
                <i class="fas fa-arrow-circle-left"></i> Kembali
            </a>
            <a href="<?= site_url('peminjaman/cetak/' . $transaksi->id_pinjam) ?>" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Cetak Bukti
            </a>
        </div>
    </div>
</div>
<!-- </section> -->