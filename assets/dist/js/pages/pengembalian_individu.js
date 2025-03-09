const url = $(document)[0].location.origin +"/perpus/";
$(".select2").select2();
$("#kd_anggota").on('change', function(){
    const kd_anggota = $(this).val();
    $.ajax({
        url:url + 'Pengembalian/ajaxDataPeminjamanBuku',
        type: 'POST',
        data:{'kd_anggota':kd_anggota},
        dataType:"JSON",
        success: function(response) 
        {
            const dataAnggota = response['dataAnggota'];
            const htmlAnggota = `
                <div class="box box-solid new-shadow">
                    <div class="box-header">DATA ANGGOTA</div>
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <td>Nama Lengkap</td>
                                <th>:</th>
                                <td> ${dataAnggota['nama_anggota']}</td>
                            </tr>
                            <tr>
                                <td>NIS/NIP</td>
                                <th>:</th>
                                <td>${dataAnggota['kd_anggota']}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <th>:</th>
                                <td>${dataAnggota['jk'] == '0' ? 'Laki-Laki' : 'Perempuan'}</td>
                            </tr>
                            <tr>
                                <td>Nomor HP</td>
                                <th>:</th>
                                <td>${dataAnggota['nohp']}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <th>:</th>
                                <td>${dataAnggota['status_anggota'] == '0' ? 'Guru' : 'Siswa' }</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <th>:</th>
                                <td>${dataAnggota['alamat'] }</td>
                            </tr>
                        </table>
                    </div>
                   
                </div>`;
            $('.dataAnggota').html(htmlAnggota);
            $('.dataBuku').html("");
            response['dataBuku'].forEach(element => {
                const html = `                   
                    <div class="box box-widget widget-user box-solid new-shadow">
                        <div class="widget-user-header bg-black" style="background: url('${url+'/assets/dist/img/buku/'+element['foto']}') center center;">
                            <h3 class="widget-user-username">${element['judul_buku']}</h3>
                            <h5 class="widget-user-desc">Penulis : ${element['penulis']}</h5>
                        </div>       
                        <div class="box-footer">
                            <table class="table">                               
                                <tr>
                                    <td>Judul Buku</td>
                                    <th>:</th>
                                    <td> ${element['judul_buku']}</td>
                                </tr>
                                <tr>
                                    <td>Pengarang</td>
                                    <th>:</th>
                                    <td> ${element['penulis']}</td>
                                </tr>
                                <tr>
                                    <td>Penerbit</td>
                                    <th>:</th>
                                    <td> ${element['penerbit']}</td>
                                </tr>
                                <tr>
                                    <td>ISBN</td>
                                    <th>:</th>
                                    <td> ${element['isbn']}</td>
                                </tr>
                                <tr>
                                    <td>Tahun terbit</td>
                                    <th>:</th>
                                    <td> ${element['tahun_terbit']}</td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <th>:</th>
                                    <td> ${element['kategori']}</td>
                                </tr>
                                <tr>
                                    <td>Rak</td>
                                    <th>:</th>
                                    <td> ${element['nama_rak']}</td>
                                </tr>                                  
                            </table>
                            <buton class="btn btn-block btn-primary">Ajukan Pengembalian Buku</buton>          
                        </div>
                    </div>`;
                $('.dataBuku').append(html);
            });
           
        }
    })
})