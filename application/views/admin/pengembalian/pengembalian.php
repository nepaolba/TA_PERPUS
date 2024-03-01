<div class="row">
    <div class="col-lg-12 ">
        <div class="box box-solid new-shadow">
            <div class="box-header text-center">
                <span><i class="fa fa-calendar"></i> Tanggal Pengembalian : <?= date("d/m/Y") ?> </span>
            </div>
            <div class="box-body d-flex justify-content-center">
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="form-group d-flex justify-content-between">
                            <label for="individu">
                                <input type="radio" name="jenisPinjam" class="flat-red jenis-pinjam" value="individu" id="individu" checked>
                                INDIVIDU
                            </label>
                            <label for="kelompok">
                                <input type="radio" name="jenisPinjam" class="flat-red jenis-pinjam" value="kelompok" id="kelompok">
                                KELOMPOK
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="box box-solid new-shadow">
            <form action="<?= base_url('Peminjaman/submitPengembalian') ?>" id="addPengembalian" method="post">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12 " id="input-box">
                            <div class="form-group">
                                <label for="kd_anggota">Nama Anggota</label>
                                <div id="input-anggota"></div>
                            </div>
                            <div id="detail-pinjam"></div>
                        </div>
                    </div>
                </div>
                <div class="box-footer " id="box-footer">
                    <button type="submit" class="btn btn-block bg-aqua" id="btn-add"><i class="fa fa-check"></i> <small>AJUKAN PEMGEMBALIAN</small></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-5 detail-anggota"></div>
    <div class="col-lg-5 pull-right detail-book"></div>
</div>