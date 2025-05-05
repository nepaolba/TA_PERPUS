<div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
<div class="col-12 col-md-12 col-lg-12">
    <div class="card">
        <form method="post" action="<?= base_url('Welcome/profil') ?>">
            <div class="card-header">
                <h4>Edit Profil </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12 col-12">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_anggota" value="<?= set_value('nama_anggota', $data['nama_anggota']) ?>" required="">
                        <?= form_error('nama_anggota', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-7 col-12">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?= set_value('alamat', $data['alamat']) ?>" required="">
                        <?= form_error('alamat', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                    </div>
                    <div class="form-group col-md-5 col-12">
                        <label>NO.HP</label>
                        <input type="tel" class="form-control" id="nohp" value="<?= set_value('nohp', $data['nohp']) ?>" name="nohp" data-inputmask="'mask': ['089999999999']" data-mask>
                        <?= form_error('nohp', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="laki">
                        <input type="radio" name="jk" id="laki" class="flat-red" value="0" <?= ($data['jk'] == '0') ? 'checked' : ''; ?>>
                        Laki-Laki
                    </label>&nbsp;&nbsp;
                    <label for="wanita">
                        <input type="radio" id="wanita" name="jk" class="flat-red" value="1" <?= ($data['jk'] == '1') ? 'checked' : ''; ?>>
                        Perempuan
                    </label>
                    <?= form_error('jk', '<small class="text-danger"><i class="fa fa-times-circle"></i> ', '</small>') ?>

                </div>


            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });
    const flash = $("#flash").data("flash");
    const flashClass = $("#flash").data("class");
    flash
        ?
        flashClass == "error" ?
        notif(flash, flashClass) :
        notif(flash, flashClass) :
        "";

    function notif(Fnotif, Fclass) {
        Swal.fire({
            title: Fclass.toUpperCase(),
            text: Fnotif,
            icon: Fclass
        });
    }
</script>