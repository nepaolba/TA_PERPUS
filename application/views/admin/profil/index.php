<div class="row">
    <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" , data-class="<?= $this->session->flashdata('class') ?>"></div>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">IDENTITAS PERPUS</h3>
            </div>
            <form action="<?= base_url('Profil/ubahProfil') ?>" method="post">
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Nama Perpustakaan</th>
                            <th>:</th>
                            <td>
                                <input type="text" class="form-control" name="nm_perpus" value="<?= set_value('nm_perpus', $data->nm_perpus) ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Status Perpus</th>
                            <th>:</th>
                            <td>
                                <input type="text" class="form-control" name="sts_perpus" value="<?= set_value('sts_perpus', $data->sts_perpus) ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <td>
                                <input type="text" class="form-control" name="alamat" value="<?= set_value('alamat', $data->alamat) ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <td>
                                <input type="text" class="form-control" name="email" value="<?= set_value('email', $data->email) ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>No Telpon</th>
                            <th>:</th>
                            <td>
                                <input type="text" class="form-control" name="hp" value="<?= set_value('hp', $data->hp) ?>">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-block" type="submit"><small>SIMPAN PERUBAHAN</small></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">SAMBUTAN KEPALA SEKOLAH</h3>
            </div>
            <form action="<?= base_url('Profil/ubahProfil') ?>" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <textarea class="form-control" name="sambutan" rows="14"><?= $data->sambutan ?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-block" type="submit"><small>SIMPAN PERUBAHAN</small></button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .mb-3 {
            margin-bottom: 30px;
        }

        .radius-15 {
            border-radius: 15px;
        }

        img {
            cursor: pointer;
        }
    </style>
</div>
<div class="row">

    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">VISI & MISI</h3>
            </div>
            <form action="<?= base_url('Profil/ubahProfil') ?>" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="">VISI</label>
                        <textarea class="form-control" name="visi" rows="3"><?= $data->visi ?> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="">MISI</label>
                        <textarea name="misi" class="form-control" cols="20" rows="13"><?= $data->misi ?> </textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-block" type="submit"><small>SIMPAN PERUBAHAN</small></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">PERATURAN PEMINJAMAN</h3>
            </div>
            <form action="<?= base_url('Profil/ubahProfil') ?>" method="post">
                <div class="box-body">
                    <textarea name="aturan" id="input" class="form-control" rows="21" required="required"><?= $data->aturan ?></textarea>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-block"><small>SIMPAN PERUBAHAN</small></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">WAKTU LAYANAN</h3>
            </div>
            <form action="<?= base_url('Profil/ubahProfil') ?>" method="post">
                <div class="box-body">
                    <textarea name="layanan" id="input" class="form-control" rows="8" required="required"><?= $data->layanan ?></textarea>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-block" type="submit"><small>SIMPAN PERUBAHAN</small></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Slide Foto</h3>
            </div>
            <div class="box-body img-slide">
                <?php foreach ($slide as $key => $value) : ?>
                    <form action="<?= base_url('Profil/ubahSlide/' . $value->id) ?>" method="post" enctype="multipart/form-data">
                        <div class="col-lg-3 mb-3">
                            <img src="<?= base_url('assets/dist/img/slide/' . $value->img) ?>" width="100%" height="300" class="radius-15" alt="" style="object-fit: cover;">
                            <br><br>
                            <input type="file" class="form-control" name="img">
                            <br>
                            <button class="btn btn-primary btn-block" type="submit"><small>UBAH FOTO</small></button>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>