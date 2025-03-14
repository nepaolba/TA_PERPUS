<div class="row">
    <div class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-header">
                <h3 class="box-title">Pengembalian Individu</h3>
            </div>
            <form action="<?= base_url('Pengembalian/daftarBuku') ?>" method="post">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-10">
                            <input type="hidden" name="jenisPinjam" value="0">
                            <div class="form-group">
                                <select name="kd_anggota" class="form-control input-lg select2">
                                    <option value="">Pilih Anggota</option>
                                    <?php foreach ($peminjamanIndividu as $v_peminjaman) : ?>
                                        <option value="<?= $v_peminjaman->nis_nip ?>"><?= $v_peminjaman->nis_nip . ' -- ' . $v_peminjaman->nama_anggota ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-block btn-primary">Cek Peminjaman Buku</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- </div> -->

        </div>
    </div>
    <div class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-header">
                <h3 class="box-title">Pengembalian Kelas</h3>
            </div>
            <div class="box-body">
                <form action="<?= base_url('Pengembalian/daftarBuku') ?>" method="post">
                    <div class="col-lg-10">
                        <input type="hidden" name="jenisPinjam" value="1">
                        <div class="form-group">
                            <select name="kd_anggota" class="form-control input-lg select2">
                                <option value="">Pilih Anggota</option>
                                <?php foreach ($peminjamanKelompok as $k_peminjaman) : ?>
                                    <option value="<?= $k_peminjaman->nis_nip ?>"><?= $k_peminjaman->nis_nip . ' -- ' . $k_peminjaman->nama_anggota ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-block btn-primary">Cek Peminjaman Buku</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>