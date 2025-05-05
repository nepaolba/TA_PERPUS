<div class="row">
    <div class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-body">
                <table class="table" id="example1">
                    <thead>
                        <tr>
                            <!-- <th>Nama Anggota</th> -->
                            <th>Judul Buku</th>
                            <!-- <th>Jumlah</th> -->
                            <th>Tgl Pinjam</th>
                            <th>Tenggat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href=""><?= $datapinjam->judul_buku ?></a>
                                <p>Pengarang : <?= $datapinjam->penulis ?></p>
                            </td>
                            <td><?= $datapinjam->tgl_pinjam ?></td>
                            <td><?= $datapinjam->tgl_kembali ?></td>
                            <td>

                                <?php if (time() > strtotime($datapinjam->tgl_kembali)): ?>
                                    <!-- <a href="<?= $datapinjam->id_pinjam ?>" class="btn bg-info btn-xs mb2"><i class="glyphicon glyphicon-zoom-in"></i> <small>Pelunasan Denda</small></a> -->
                                    <a href="#modal-denda<?= $datapinjam->id_pinjam ?>" data-toggle="modal" class="btn bg-teal btn-xs mb2"><i class="glyphicon glyphicon-zoom-in"></i> <small>Ajukan pengembalian buku</small></a>







                                    <div class="modal fade" id="modal-denda<?= $datapinjam->id_pinjam ?>">
                                        <div class="modal-dialog ">
                                            <div class="modal-content" style="border-radius: 5px;">
                                                <div class="modal-body">
                                                    <br>
                                                    <div class="" style="display: flex; flex-direction: column;align-items: center ">
                                                        <i class="fa fa-warning text-orange" style="font-size: 5rem;"></i>
                                                        <h4 class="modal-title text-orange"><strong>OPSSS</strong></h4>
                                                        <p class="text-center"><b><?= $datapinjam->nama_anggota ?></b> telat mengembalikan buku <b><?= $datapinjam->judul_buku ?></b>. tanggal pengembalian buku <b><?= $datapinjam->tgl_kembali ?></b> apakah anda ingin melanjutkan </p>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><small>Batal</small></button>
                                                    <a href="<?= base_url('Pengembalian/submitPengembalian/' . $datapinjam->id_pinjam . '/' . $datapinjam->kd_buku) ?>" class="btn btn-sm btn-primary"><small>Ya, lanjutkan</small></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <a href="<?= base_url('Pengembalian/submitPengembalian/' . $datapinjam->id_pinjam . '/' . $datapinjam->kd_buku) ?>" class="btn bg-teal btn-xs mb2"><i class="glyphicon glyphicon-zoom-in"></i> <small>Ajukan pengembalian buku</small></a>
                                <?php endif; ?>







                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>