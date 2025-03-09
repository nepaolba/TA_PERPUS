<div class="col-12 col-md-12 col-sm-12 ml-auto">
    <div class="card">
        <!-- <div class="card-header">
            <h4>Empty Data</h4>
        </div> -->
        <div class="card-body" style="border: 2px solid grey;">
            <div class="empty-state" data-height="400" style="height: 200px;">
                <!-- <div class="empty-state-icon"> -->
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQiD-_xPJHcic8LvJWL0p0sIbT4u2t0kjUyw&s" alt="" width="100">
                <!-- </div> -->
                <h3 class="mt-3">KARTU ANGGOTA</h3>
                <h5><?= $profil->nm_perpus ?></h5>
                <p style="border-bottom: 2px solid grey;"><?= $profil->alamat ?></p>
                <!-- <hr> -->
                <!-- <div class="d-flex"> -->
                <table style="width: 100%;">
                    <tr>
                        <th>Kode Anggota </th>
                        <th>:</th>
                        <td><?= $anggota['kd_anggota'] ?></td>
                    </tr>
                    <tr>
                        <th>Nama </th>
                        <th>:</th>
                        <td><?= $anggota['nama_anggota'] ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td><?= $anggota['alamat'] ?></td>
                    </tr>
                    <tr>
                        <th>Berlaku S/D</th>
                        <th>:</th>
                        <td><?= $anggota['alamat'] ?></td>
                    </tr>
                </table>
                <!-- </div> -->
                <a href="#" class="btn btn-primary mt-4" id="btn">Cetak Kartu Anggota</a>
                <!-- <a href="#" class="mt-4 bb">Need Help?</a> -->
            </div>
        </div>
    </div>
</div>
<script>
    const printJs = window["printJS"]
    document.getElementById('btn').onclick = function() {
        printJs({
            printable: 'invoice',
            type: 'html',
            honorColor: true,
            font_size: '11px',
            css: "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css",
            modalMessage: "Silakan print invoice anda",
            documentTitle: "invoice example"
        })
    }
</script>