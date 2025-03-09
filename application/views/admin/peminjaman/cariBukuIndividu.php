<style>
    .icheckbox_flat-green.checked.disabled {
        background-position: -22px 0;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right;
    }

    .dataTables_wrapper .dataTables_length {
        float: left;
    }
</style>
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
                <!-- <div class="col-lg-6">
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
                </div> -->
                <div class="col-lg-12">
                    <div class="box-header data-kdanggota" data-kdanggota="<?= $dataAnggota['kd_anggota'] ?>">
                        <h3 class="box-title">DATA ANGGOTA</h3>
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
                    </table>
                </div>

                <div class="col-lg-12 ">

                    <div class="form-group">
                        <label for="pilih-buku">Pilih Judul Buku</label>
                        <select name="pilih-buku" id="pilih-buku" class="form-control">
                            <option value="">ll</option>
                            <?php foreach ($dataBuku as $buku): ?>
                                <option value=""><?= $buku['judul_buku'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-primary">Ajukan</button>


                </div>

            </div>
        </div>
    </div>
</div>