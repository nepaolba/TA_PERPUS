<div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>

<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Individu</a></li>
            <li><a href="#settings" data-toggle="tab">Kelas</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-8 ">
                        <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
                        <div class="alert alert-info alert-custom">
                            <ul>
                                <li style="list-style: none; display:flex;align-items: center; margin-left: -25px;font-size: 15px;"><i class="fa fa-info-circle" style="font-size: 25px;"></i> &nbsp;INFORMASI</li>
                                <li> 1 anggota hanya dapat meminjam 3 buku yang berbeda </li>
                                <li> 1 anggota hanya dapat melakukan peminjaman pertama selama 3 hari </li>
                                <li> Masa lama perpanjang peminjaman 1 minggu / 7 hari</li>
                                <li> Perpanjang peminjaman hanya bisa dilakukan satu kali</li>
                                <li> Jika peminjaman sudah mencapai maksimal peminjaman maka peminjaman tidak dapat dilakukan </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" action="<?= base_url('Pinjam/tambahPeminjaman') ?>" method="post">
                    <input type="hidden" value="individu" name="jenis">
                    <div class="form-group">
                        <label for="pilih-anggota" class="col-sm-2 control-label">Pilih Anggota</label>
                        <div class="col-sm-8">
                            <select name="pilih-anggota" id="pilih-anggota" class="form-control select2">
                                <option value="">PILIH ANGGOTA</option>
                                <?php foreach ($dataAnggota as $anggota): ?>
                                    <option value="<?= $anggota['kd_anggota'] ?>" <?= set_select('pilih-anggota', $anggota['kd_anggota']) ?>><?= $anggota['nama_anggota'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('pilih-anggota', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori-buku" class="col-sm-2 control-label">Kategori Buku</label>
                        <div class="col-sm-8">
                            <select name="kategori-buku" id="kategori-buku" class="form-control select2">
                                <option value="">PILIH KATEGORI BUKU</option>
                            </select>
                            <?= form_error('kategori-buku', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul-buku" class="col-sm-2 control-label">Buku</label>
                        <div class="col-sm-8">
                            <select name="judul-buku" id="judul-buku" class="form-control select2">
                                <option value="">PILIH JUDUL BUKU</option>
                            </select>
                            <?= form_error('judul-buku', '<small class="text-danger">', '</small>') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jatu_tempo" class="col-sm-2 control-label">Tanggal Jatuh tempo</label>
                        <div class="col-lg-2">
                            <input type="date" name="jatu_tempo" class="form-control">
                        </div>
                    </div>
                    <div id="jumlahPinjam"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="<?= base_url('Pinjam') ?>" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="settings">
                <form class="form-horizontal" method="post" action="<?= base_url('Pinjam/simpanPeminjamanKelas/') ?>">
                    <div class="form-group">
                        <label for="pilih-anggota-kelas" class="col-sm-2 control-label">Penangung Jawab</label>
                        <div class="col-sm-5">
                            <select name="pilih-anggota-kelas1" id="pilih-anggota-kelas1" class="form-control select2" style="width: 100%;">
                                <option value="">PILIH ANGGOTA</option>
                                <?php foreach ($dataAnggota as $anggotak): ?>
                                    <?php if ($anggotak['jenis_anggota'] == 1): ?>
                                        <option value="<?= $anggotak['kd_anggota'] ?>"><?= $anggotak['nama_anggota'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <select name="pilih-anggota-kelas2" id="pilih-anggota-kelas2" class="form-control select2" style="width: 100%;">
                                <option value="">PILIH ANGGOTA</option>
                                <?php foreach ($dataAnggota as $anggotak): ?>
                                    <?php if ($anggotak['jenis_anggota'] == 1): ?>
                                        <option value="<?= $anggotak['kd_anggota'] ?>"><?= $anggotak['nama_anggota'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas" class="col-sm-2 control-label">Kelas</label>
                        <div class="col-sm-3">
                            <select name="kelas" id="kelas" class="form-control " required>
                                <option value="">Pilih Kelas</option>
                                <option value="X" <?= set_select('kelas', 'X'); ?>>X</option>
                                <option value="XI" <?= set_select('kelas', 'XI'); ?>>XI</option>
                                <option value="XI" <?= set_select('kelas', 'XII'); ?>>XII</option>
                            </select>
                        </div>
                        <div class="jurusan-box col-sm-3"></div>
                        <div class="rombel-box col-sm-4">
                            <select name="rombel" id="rombel" class="form-control rombel " required>
                                <option value="">Pilih Rombel</option>
                                <?php
                                $alfabet = array();
                                for ($i = 65; $i <= 90; $i++) {
                                    $alfabet[] = "<option>" . chr($i) . "</option>";
                                }
                                echo implode('', $alfabet);
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kategori-buku-kelas" class="col-sm-2 control-label">Kategori Buku</label>
                        <div class="col-sm-10">
                            <select name="kategoribukukelas" class="form-control select2" id="kategori-buku-kelas" style="width: 100%;">
                                <option value="">PILIH KATEGORI BUKU</option>
                                <?php foreach ($dataKategori as $kategoriK): ?>
                                    <option value="<?= $kategoriK['kd_kategori'] ?>"><?= $kategoriK['kategori'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul-buku-kelas" class="col-sm-2 control-label">Buku</label>
                        <div class="col-sm-10">
                            <select name="judul-buku-kelas" id="judul-buku-kelas" class="form-control select2" style="width: 100%;">
                                <option value="">PILIH JUDUL BUKU</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_buku" class="col-sm-2 control-label">Jumlah Buku</label>
                        <div class="col-sm-2">
                            <input type="number" id="jumlah_buku" name="jumlah_buku" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam" class="col-sm-2 control-label">Jam Pinjam</label>
                        <div class="col-sm-2">
                            <input type="text" id="jam" name="jam" readonly class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="tanggal" class="col-sm-2 control-label">Jam Pengembalian</label>
                        <div class="col-sm-2">
                            <input type="time" id="tanggal" name="tanggal" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
</div>