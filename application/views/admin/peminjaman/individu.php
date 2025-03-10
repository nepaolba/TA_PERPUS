<div class="row">
    <div class="col-lg-12">
        <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
        <div class="alert alert-info alert-custom">
            <ul>
                <li style="list-style: none; display:flex;align-items: center; margin-left: -25px;font-size: 15px;"><i class="fa fa-info-circle" style="font-size: 25px;"></i> &nbsp;INFORMASI</li>
                <li> 1 anggota hanya dapat meminjam 3 buku yang berbeda </li>
                <li> Jika peminjaman sudah mencapai maksimal peminjaman maka peminjaman tidak dapat dilakukan </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="box box-solid">
            <div class="box-header">Peminjaman</div>
            <form action="<?= base_url('Peminjaman_individu/pinjam_buku') ?>" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="pilih-anggota">Pilih Anggota</label>
                        <select name="pilih-anggota" id="pilih-anggota" class="form-control select2">
                            <option value="">PILIH ANGGOTA</option>
                            <?php foreach ($dataAnggota as $anggota): ?>
                                <option value="<?= $anggota->kd_anggota ?>"><?= $anggota->nama_anggota ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori-buku">Kategori Buku</label>
                        <select name="kategori-buku" id="kategori-buku" class="form-control select2">
                            <option value="">PILIH KATEGORI BUKU</option>
                            <?php foreach ($dataKategori as $kategori): ?>
                                <option value="<?= $kategori->kd_kategori ?>"><?= $kategori->kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="judul-buku">Buku</label>
                        <select name="judul-buku" id="judul-buku" class="form-control select2">
                            <option value="">PILIH JUDUL BUKU</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="jatu_tempo">Tanggal Jatuh tempo</label>
                                <input type="date" name="jatu_tempo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="box box-solid">
            <div class="box-header">
                <h3>Informasi Peminjam</h3>
            </div>
            <div class="box-body">
                ll
            </div>
        </div>
        <div class="box box-solid">
            <div class="box-header">
                <h3>Informasi Pustaka</h3>
            </div>
            <div class="box-body">
                ll
            </div>
        </div>
    </div>