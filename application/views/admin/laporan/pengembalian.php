<div class="row">
    <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
    <div class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-body">
                <table class="table" id="example1">
                    <thead>
                        <tr>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Jumlah</th>
                            <th>Tgl Pinjam</th>
                            <th>Tenggat</th>
                            <th>Tgl Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pengembalian as $key => $value) : ?>
                            <tr>
                                <td>
                                    <a href=""><?= $value['nama_anggota'] ?></a><br>
                                    <?= $value['kelas'] ?>
                                </td>
                                <td>
                                    <a href=""><?= $value['judul_buku'] ?></a>
                                    <p>Pengarang : <?= $value['penulis'] ?></p>
                                </td>
                                <td><?= $value['jumlah_kembali'] ?></td>
                                <td><?= $value['tgl_pinjam'] ?></td>
                                <td><?= $value['tgl_kembali'] ?></td>
                                <td><?= $value['tgl'] ?></td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>