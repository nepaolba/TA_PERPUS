
// function loadDataTables(){
//     $("#peminjaman").DataTable({	
//         ordering: false,
//         autoWidth: true,   
//         language: {
//             search: ""
//         },
//     });
// }

// loadDataTables();
// // action="<?= base_url('Laporan/filter'); ?>"
// $('#frm-filter-pinjam').on('submit', function(event){
// 	event.preventDefault();
//     const dataFRM = $(this).serialize();
//     const dataObject = Object.fromEntries(new URLSearchParams(dataFRM));
//     if(dataObject.start_date != "" && dataObject.end_date != ""){
//         const startDate = new Date(dataObject.start_date);
//         const endDate = new Date(dataObject.end_date);
//         if (startDate <= endDate) {
            

//             $.ajax({
//                 url:url + 'filter',
//                 type: 'POST',
//                 data:{start_date : dataObject.start_date, end_date:dataObject.end_date },
//                 dataType:"JSON",
//                 success: function(response) 
//                 {
//                     console.log(response)
//                     // let htmlBukuAnggotaIndividu ="";
//                     // let i = 1;
//                     // response.forEach(element => {
//                     //     htmlBukuAnggotaIndividu += `
//                     //         <tr>
//                     //         <td>
//                     //             <div class="form-group">
//                     //             <a href="${url+"Peminjaman/cekPeminjamanKelompok/"+$('#anggota').data('anggota')+"/"+element.kd_buku+"/"+$('#anggota').data('kelas')}" class="btn btn-sm btn-primary" >PILIH</a>
                                    
//                     //             </div>
//                     //         </td>
//                     //             <td>
//                     //                 <div class="buku d-flex justify-content-center">
//                     //                     <img src="${url+"assets/dist/img/buku/"+element.foto}" class="image-fluid" width="100" height="100" alt="">
//                     //                 </div>
//                     //             </td>
//                     //             <td>
//                     //                 <h5>${element.judul_buku}</h5>
//                     //                 <p>PENULIS : ${element.penulis}</p>
//                     //             </td>
//                     //             <td>${element.penerbit}</td>
//                     //             <td>${element.kategori}</td>
//                     //             <td>${element.nama_rak}</td>
//                     //             <td>${element.sisa_stok}</td>
                                
//                     //         </tr>`;
//                     // });
//                     // $("#table-cari-buku-individu>tbody").html(htmlBukuAnggotaIndividu); 
                    
//                 }
//             });



//         } else {
//             console.log('Tanggal mulai harus dibawa atau sama dengan tanggal akhir');
//         }
//     }else{
//         console.log('kosong');
//     }
// });

$(document).ready(function() {
    var table = $('#peminjaman').DataTable({
        processing: true, // Menampilkan loading saat mengambil data
        serverSide: true, // Memungkinkan pemrosesan server-side
        ajax: {
            url: url + 'filter', // URL untuk mengambil data
            type: 'POST', // Metode POST
            data: function(d) {
                // Menambahkan parameter start_date dan end_date
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                if (start_date && end_date) {
                    d.start_date = start_date;
                    d.end_date = end_date;
                }

                // Data pagination, akan ditangani oleh server
                d.start = d.start;  // Offset data untuk pagination
                d.length = d.length; // Number of records per page
                d.draw = d.draw; // Untuk keperluan pengulangan permintaan
            },
            dataType: 'json',
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        },
        columns: [
            { data: 'nama_anggota' },
            { data: 'judul_buku' },
            { data: 'tgl_pinjam' },
            { data: 'tgl_kembali' },
            { data: 'jumlah_pinjam' },
            { data: 'kelas' }
        ],
        columnDefs: [
            {
                targets: 2, // Tgl Pinjam
                render: function(data, type, row) {
                    return new Date(data).toLocaleString(); // Format tanggal
                }
            },
            {
                targets: 3, // Tenggat
                render: function(data, type, row) {
                    return new Date(data).toLocaleString(); // Format tanggal
                }
            },
            {
                targets: 5, // Jenis Pinjam
                render: function(data, type, row) {
                    return data ? "Kelas: " + data : "Individu"; // Jenis pinjam
                }
            }
        ]
    });

    // Menangani event ketika tombol filter ditekan
    $('#frm-filter-pinjam').on('submit', function(event) {
        event.preventDefault(); // Mencegah reload halaman
        // Memuat ulang DataTable dengan parameter filter yang baru
        table.ajax.reload();
    });
});
$(document).ready(function() {
    var table = $('#pengembalian').DataTable({
        processing: true, // Menampilkan loading saat mengambil data
        serverSide: true, // Memungkinkan pemrosesan server-side
        ajax: {
            url: url + 'filter_pengembalian', // URL untuk mengambil data pengembalian
            type: 'POST', // Metode POST
            data: function(d) {
                var start_date = $('#start_date').val(); // Ambil nilai start_date
                var end_date = $('#end_date').val(); // Ambil nilai end_date
                if (start_date && end_date) {
                    d.start_date = start_date; // Mengirimkan start_date
                    d.end_date = end_date; // Mengirimkan end_date
                }
                // Data pagination (start, length) untuk DataTables
                d.start = d.start;
                d.length = d.length;
                d.draw = d.draw;
            },
            dataType: 'json',
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        },
        columns: [
            { data: 'nama_anggota' },
            { data: 'judul_buku' },
            { data: 'jumlah_kembali' },
            { data: 'tgl_pinjam' },
            { data: 'tgl_kembali' },
            { data: 'tgl' }
        ],
        columnDefs: [
            {
                targets: 3, // Tgl Pinjam
                render: function(data, type, row) {
                    return new Date(data).toLocaleString(); // Format tanggal
                }
            },
            {
                targets: 4, // Tenggat
                render: function(data, type, row) {
                    return new Date(data).toLocaleString(); // Format tanggal
                }
            },
            {
                targets: 5, // Tgl Pengembalian
                render: function(data, type, row) {
                    return new Date(data).toLocaleString(); // Format tanggal
                }
            }
        ]
    });

    // Menangani event ketika tombol filter ditekan
    $('#frm-filter-pengembalian').on('submit', function(event) {
        event.preventDefault(); // Mencegah reload halaman
        // Memuat ulang DataTable dengan parameter filter yang baru
        table.ajax.reload();
    });
});








