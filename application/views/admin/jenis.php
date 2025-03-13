<div class="row">
    <div class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-body">
                <form action="<?= base_url('Admin/validasiJenisPinjam') ?>" method="post">
                    <!-- <div class="col-lg-10"> -->
                        <input type="hidden" name="jns" value="<?= $jenis?>">
                        <div class="form-group">
                            <select name="jenisPinjam" class="form-control input-lg select2">
                                <option value="0">Individu</option>
                                <option value="1">Kelas</option>                               
                            </select>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="col-lg-2"> -->
                        <button type="submit" class="btn btn-block btn-primary">Lanjut</button>
                    <!-- </div> -->
                </form>
            </div>
        </div>
    </div>
</div>