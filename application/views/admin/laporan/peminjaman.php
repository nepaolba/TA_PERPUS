<div class="row">
    <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>" data-class="<?= $this->session->flashdata('class') ?>"></div>
    <div class="col-lg-12">
        <div class="box box-solid new-shadow">
            <div class="box-body table-responsive">
                <table class="table" id="peminjaman">
                    <thead>
                        <tr>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tenggat</th>
                            <th>Jumlah Pinjam</th>
                            <th>Jenis Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $this->session->set_flashdata('kembali', 'Peminjaman') ?>
                        <?php foreach ($peminjaman as  $pinjam) : ?>
                            <tr>
                                <td>
                                    <a href="<?= base_url('Anggota/detail/' . $pinjam['nis_nip']) ?>"><?= $pinjam['nama_anggota'] ?></a>
                                </td>
                                <td>
                                    <a href="<?= base_url('Buku/detail/' . $pinjam['kd_buku']) ?>"> <?= character_limiter($pinjam['judul_buku'], 70); ?></a>
                                </td>
                                <td>
                                    <?= date("d/m/Y - H:i:s", strtotime($pinjam['tgl_pinjam'])) ?>
                                </td>
                                <td>
                                    <?= date("d/m/Y - H:i:s", strtotime($pinjam['tgl_kembali'])) ?>
                                </td>
                                <td class="text-center"><?= $pinjam['jumlah_pinjam'] ?></td>
                                <td class="text-center"><?= $pinjam['kelas'] != '' ? "Kelas :" . $pinjam['kelas'] : 'Individu'  ?></td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>