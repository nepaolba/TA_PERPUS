<div class="row">

    <div class="col-lg-6">
        <div class="box box-solid new-shadow">
            <div class="box-header">
                <h3>PILIH BUKU</h3>
            </div>
            <form action="<?= base_url('Buku/cariBuku'); ?>" method="post" id="frm-cari-buku">
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Cari Judul, pengarang atau penerbit buku</label>
                        <input type="text" class="form-control" name="keyword" placeholder="Cari berdasarkan Judul, pengarang atau penerbit buku">
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-sm">CARI BUKU</button>
                </div>
                <br>
                <br>
                <br>
                <br><br>
            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="box box-solid new-shadow">
            <div class="box-header">
                <h3>DATA ANGGOTA</h3>
            </div>
            <div class="box-body box-pencarian">
                <table class="table">
                    <tr>
                        <td>Nama Lengkap</td>
                        <th>:</th>
                        <td><?= $anggota['nama_anggota'] ?></td>
                    </tr>
                    <tr>
                        <td>NIS/NIP</td>
                        <th>:</th>
                        <td><?= $anggota['kd_anggota'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <th>:</th>
                        <td><?= $anggota['jk'] == '0' ? 'Laki-Laki' : 'Perempuan' ?></td>
                    </tr>
                    <tr>
                        <td>Nomor HP</td>
                        <th>:</th>
                        <td><?= $anggota['nohp'] ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <th>:</th>
                        <td><?= $anggota['status_anggota'] == '0' ? 'Guru' : 'Siswa' ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <th>:</th>
                        <td><?= $anggota['alamat'] ?></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <h3>BUKU YANG DIPILIH</h3>
        <div class="callout callout-warning">
            <h4>Informasi!</h4>
            <p> satu anggota hanya bisa meminyam satu buku dengan judul yang sama</p>
            <p> batas peminjaman satu anggota 3 buku dengan judul berbeda</p>
        </div>
    </div>
    <div class="box-pilih-buku">

    </div>
    <div class="col-lg-12">
        <button class="btn btn-info btn-block">KONFIRMASI PEMINJAMAN BUKU</button>
        <br><br><br>
    </div>
    <div class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-header">
                <h3>HASIL PENCARIAN BUKU</h3>
            </div>
            <div class="box-body box-hasil-pencarian">

            </div>
        </div>
    </div>

</div>