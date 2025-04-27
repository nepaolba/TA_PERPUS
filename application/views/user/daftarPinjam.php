<div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>


<!-- <div class="row"> -->
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Transaksi Peminjaman Buku Anda</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>No Transaksi</th>
                            <th>Judul Buku</th>
                            <!-- <th>Tanggal Pinjam</th> -->
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pinjam as $pj): ?>
                            <tr>
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td><?= $pj->id_pinjam ?></td>
                                <td><?= $pj->judul_buku ?></td>
                                <!-- <td><?= $pj->tgl_pinjam ?> </td> -->
                                <td><?= $pj->tgl_kembali ?></td>
                                <td>
                                    <?php if ($pj->status == 'pandding'): ?>
                                        <div class="badge badge-warning">Sedang diProses</div>
                                    <?php else: ?>
                                        <div class="badge badge-success">Completed</div>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if ($pj->status == 'pandding'): ?>
                                        <a href="<?= base_url('Welcome/hapusPeminjaman/' . $pj->id_pinjam) ?>" class="btn btn-sm btn-icon btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    <?php else: ?>
                                        <a href="<?= base_url('Welcome/bukti/' . $pj->id_pinjam) ?>" class="btn btn-sm btn-icon btn-info"><i class="fas fa-scroll"></i> Struk</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->











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