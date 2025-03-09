<div class="row">
    <div class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-body">
                <form action="<?= base_url('Pengembalian/daftarBuku') ?>" method="post">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <select name="kd_anggota" class="form-control input-lg select2">
                                <option value="">Pilih Anggota</option>
                                <?php foreach ($peminjaman as $v_peminjaman) : ?>
                                    <option value="<?= $v_peminjaman->nis_nip ?>"><?= $v_peminjaman->nis_nip . ' -- ' . $v_peminjaman->nama_anggota ?></option>
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