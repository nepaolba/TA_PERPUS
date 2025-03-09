<div class="row">
    <div class="col-lg-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Atur Tanggal Pengembalian</h3>
            </div>
            <div class="box-body">
                <script type="text/javascript">
                    function showTime() {
                        var a_p = "";
                        var today = new Date();
                        var curr_hour = today.getHours();
                        var curr_minute = today.getMinutes();
                        var curr_second = today.getSeconds();
                        if (curr_hour < 12) {
                            a_p = "AM";
                        } else {
                            a_p = "PM";
                        }
                        if (curr_hour == 0) {
                            curr_hour = 12;
                        }
                        if (curr_hour > 12) {
                            curr_hour = curr_hour - 12;
                        }
                        curr_hour = checkTime(curr_hour);
                        curr_minute = checkTime(curr_minute);
                        curr_second = checkTime(curr_second);
                        document.getElementById('jam').value = curr_hour + ":" + curr_minute + ":" + curr_second;
                    }

                    function checkTime(i) {
                        if (i < 10) {
                            i = "0" + i;
                        }
                        return i;
                    }
                    setInterval(showTime, 500);
                </script>
                <form action="<?= base_url("Peminjaman/simpanPeminjamanKelompok/" . $dataAnggota['kd_anggota'] . "/" . $dataBuku['kd_buku'] . "/" . $kelas) ?>" method="post">
                    <div class="form-group">
                        <label for="">Jam Pinjam</label>
                        <input type="text" id="jam" name="jam" readonly class="form-control input-lg">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Pengembalian</label>
                        <input type="time" id="tanggal" name="tanggal" class="form-control input-lg">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_buku">Jumlah Buku</label>
                        <input type="text" id="jumlah_buku" name="jumlah_buku" class="form-control input-lg">
                    </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-lg btn-block btn-primary ">Simpan</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel box box-danger">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        LIHAT DETAIL ANGGOTA
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td>Nama Lengkap</td>
                            <th>:</th>
                            <td><?= $dataAnggota['nama_anggota'] ?></td>
                        </tr>
                        <tr>
                            <td>NIS/NIP</td>
                            <th>:</th>
                            <td><?= $dataAnggota['kd_anggota'] ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <th>:</th>
                            <td><?= $dataAnggota['jk'] == '0' ? 'Laki-Laki' : 'Perempuan' ?></td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <th>:</th>
                            <td><?= $dataAnggota['nohp'] ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <th>:</th>
                            <td><?= $dataAnggota['status_anggota'] == '0' ? 'Guru' : 'Siswa' ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <th>:</th>
                            <td><?= $dataAnggota['alamat'] ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <th>:</th>
                            <td><?= $kelas ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <style>
        .box-body img {
            object-fit: cover;
        }
    </style>
    <div class="col col-lg-6">
        <div class="panel box box-danger">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTree">
                        LIHAT DETAIL BUKU
                    </a>
                </h4>
            </div>
            <div id="collapseTree" class="panel-collapse collapse">
                <div class="box-body">
                    <div class="col col-lg-4">
                        <img src="<?= base_url('assets/dist/img/buku/' . $dataBuku['foto']) ?>" alt="" width="100%">
                    </div>
                    <div class="col col-lg-8">
                        <table style="width: 100%;" class="table">
                            <tr>
                                <th width="15%">Judul</th>
                                <th width="30"> : </th>
                                <th><?= $dataBuku['judul_buku'] ?></th>
                            </tr>
                            <tr>
                                <td>Pengarang</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['penulis'] ?></td>
                            </tr>
                            <tr>
                                <td>Penerbit</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['penerbit'] ?></td>
                            </tr>
                            <tr>
                                <td>ISBN</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['isbn'] == '' ? '-' : $dataBuku['isbn'] ?></td>
                            </tr>
                            <tr>
                                <td>Tahun terbit</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['tahun_terbit'] ?></td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['kategori'] ?></td>
                            </tr>
                            <tr>
                                <td>Rak</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['nama_rak'] ?></td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['jumlah_buku'] ?></td>
                            </tr>
                            <tr>
                                <td>Dipinjam</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['jumlah_dipinjam'] ?></td>
                            </tr>
                            <tr>
                                <td>Sisa Stok</td>
                                <th width="30"> : </th>
                                <td><?= $dataBuku['sisa_stok'] ?></td>
                            </tr>
                            <tr>
                                <td>Sinopsis</td>
                                <th width="30"> : </th>
                                <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est ipsum magnam molestias et. Saepe atque veniam esse, accusamus ipsa, doloremque suscipit, ullam iusto non maxime temporibus asperiores perferendis labore libero.
                                    Quia sit culpa iste cumque ullam laboriosam magnam amet repudiandae, praesentium sequi nulla tenetur cum? Odio error nobis, excepturi magni iste itaque numquam laborum quis sint quaerat omnis est voluptatem?0</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>


</div>