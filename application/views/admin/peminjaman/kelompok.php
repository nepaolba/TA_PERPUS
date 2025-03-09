<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info alert-custom">
            <ul>
                <li style="list-style: none; display:flex;align-items: center;
    margin-left: -25px;
    font-size: 15px;"><i class="fa fa-info-circle" style="font-size: 25px;"></i> &nbsp;INFORMASI</li>
                <li> 1 anggota hanya dapat meminjam 3 buku yang berbeda </li>
                <li> Jika peminjaman sudah mencapai maksimal peminjaman maka peminjaman tidak dapat dilakukan </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-7">
        <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
        <div class="box box-solid">
            <div class="box-header">Penanggung Jawab</div>
            <form id="frm-cari-anggota" method="post" action="<?= base_url('Peminjaman/kelompok/') ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label for="pj">Penanggung Jawab</label>
                        <input type="text" name="kd_anggota" id="pj" class="form-control input-lg" placeholder="Masukan NIS/NIP/ID Anggota" required>
                        <?= form_error('kd_anggota', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="kelas">Kelas : <span id="detailKelas"></span></label>
                                <select name="kelas" id="kelas" class="form-control input-lg" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="X" <?= set_select('kelas', 'X'); ?>>X</option>
                                    <option value="XI" <?= set_select('kelas', 'XI'); ?>>XI</option>
                                    <option value="XI" <?= set_select('kelas', 'XII'); ?>>XII</option>
                                </select>
                                <?= form_error('kelas', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                            </div>
                        </div>
                        <div class="jurusan-box"></div>
                        <div class="rombel-box">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="rombel">Rombel</label>
                                    <select name="rombel" id="rombel" class="form-control rombel input-lg" required>
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
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Lanjut</button>
                </div>
            </form>


        </div>
    </div>
    <div class="col-lg-5">
        <div class="box box-solid">
            <div class="box-header">Daftar NIS/NIP/ID Anggota</div>
            <div class="box-body">
                <table id="daftarAnggota" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIS/NIP/ID</th>
                            <th>Nama Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $anggota) : ?>
                            <tr>
                                <th>
                                    <div class="form-group">
                                        <label>
                                            <input type="radio" required class="flat-red pilih-pj" name="kd_anggota" value="<?= $anggota->kd_anggota ?>">
                                            Pilih
                                        </label>
                                    </div>
                                </th>
                                <td><?= $anggota->kd_anggota ?></td>
                                <td><?= $anggota->nama_anggota ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>