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
                                    <?php
                                    $tanggal_sekarang = new DateTime();
                                    $tanggal_jatuh_tempo = new DateTime($pj->tgl_kembali);

                                    if ($tanggal_sekarang > $tanggal_jatuh_tempo) {
                                        // Sudah lewat jatuh tempo = terlambat
                                        $selisih = $tanggal_jatuh_tempo->diff($tanggal_sekarang);
                                        $status = 'terlambat';
                                    } else {
                                        // Belum lewat jatuh tempo = sisa waktu pengembalian
                                        $selisih = $tanggal_sekarang->diff($tanggal_jatuh_tempo);
                                        $status = 'sisa';
                                    }

                                    $hari = $selisih->d;
                                    $jam = $selisih->h;
                                    $menit = $selisih->i;

                                    echo '<span class="info-box-number">';

                                    if ($status === 'terlambat') {
                                        echo '<small>Terlambat: </small>';
                                    } else {
                                        echo '<small> Jatuh Tempo: </small>';
                                    }

                                    // Jika semuanya 0 (tepat waktu), tampilkan kalimat khusus
                                    if ($hari == 0 && $jam == 0 && $menit == 0) {
                                        echo 'Beberapa saat lagi';
                                    } else {
                                        if ($hari > 0) {
                                            echo $hari . ' Hari ';
                                        }
                                        if ($jam > 0) {
                                            echo $jam . ' Jam ';
                                        }
                                        if ($menit > 0) {
                                            echo $menit . ' Menit';
                                        }
                                    }

                                    echo '</span>';
                                    ?>
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