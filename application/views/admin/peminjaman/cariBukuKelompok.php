<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info alert-custom">
            <ul>
                <li style="list-style: none; display:flex;align-items: center;
    margin-left: -25px;
    font-size: 15px;"><i class="fa fa-info-circle" style="font-size: 25px;"></i> &nbsp;INFORMASI</li>
                <li> 1 anggota hanya dapat meminjam 1 buku yang sama</li>
                <li> 1 anggota hanya dapat meminjam 3 buku yang berbeda </li>
                <li> lama peminjaman 1 minggu / 7 hari terhitung saat waktu dipinjam </li>
            </ul>
        </div>
        <div class="box box-solid">
            <div class="box-body">
                <div class="col-lg-6">
                    <div class="box-header">
                        <h3 class="box-title">PILIH BUKU</h3>
                    </div>
                    <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
                    <form id="frm-cari-buku-individu">
                        <div class="form-group">
                            <label for="">Cari Judul, pengarang atau penerbit buku</label>
                            <input type="text" name="keyword" class="form-control input-lg" placeholder="Cari Judul, pengarang atau penerbit buku">
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-info">Cari</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="box-header">
                        <h3 class="box-title">DETAIL PENANGGUNG JAWAB</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <td>Nama Lengkap</td>
                            <th>:</th>
                            <td><?= $dataAnggota['nama_anggota'] ?></td>
                        </tr>
                        <tr>
                            <td>NIS/NIP</td>
                            <th>:</th>
                            <td><?= $dataAnggota['kd_anggota'] ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <th>:</th>
                            <td><?= $dataAnggota['jk'] == '0' ? 'Laki-Laki' : 'Perempuan' ?></td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <th>:</th>
                            <td><?= $dataAnggota['nohp'] ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <th>:</th>
                            <td><?= $dataAnggota['status_anggota'] == '0' ? 'Guru' : 'Siswa' ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <th>:</th>
                            <td><?= $dataAnggota['alamat'] ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <th>:</th>
                            <td><?= $kelas ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 table-responsive">
                    <div class="box-header">
                        <h3 class="box-title">HASIL PENCARIAN BUKU</h3>
                    </div>
                    <p>&nbsp;&nbsp;&nbsp; -- Data buku yang dicari akan muncul disini --</p><br>
                    <div id="anggota" data-anggota="<?= $dataAnggota['kd_anggota'] ?>" data-kelas=<?= $kelas ?>></div>
                    <table id="table-cari-buku-individu" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">SAMPUL</th>
                                <th>JUDUL</th>
                                <th>PENERBIT</th>
                                <th>KATEGORI</th>
                                <th>RAK</th>
                                <th>SISA STOK</th>
                                <!-- <th>Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>