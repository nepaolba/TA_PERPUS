const url = $(document)[0].location.origin +"/perpus/";
// $('#daftarAnggota').DataTable({
//     language: {
//         search: "Cari Anggota:"
//     },
//     pageLength: 25
// });

let maxSelections = 3;
let checkedCount = 0;
let checkedStatus = {};

let tableBook = $('#daftar-buku').DataTable({
    language: {
        search: "CARI BUKU:"
    },
    pageLength: 25,
    ordering: false,
});

$('.dataTables_filter input').removeClass('input-sm').addClass('input-lg');
$('.dataTables_filter input').css('width', '700px');
$('.dataTables_filter input').css('border', '2px solid rgb(0 172 214 / 35%);');
$('.dataTables_filter input').css('border-radius', '10px');

$('input[type="radio"].flat-red.pilih-pj').iCheck({
    radioClass   : 'iradio_flat-green',
}).on('ifChecked', function(event){	
    window.location.href = "cek_jumlah_peminjaman_individu/"+$(this).attr('id');
    // inggat ganti ke post
})

/* 
    ! 1.hanya boleh meminjam satu buku yang sama
    * 2.hanya boleh meminjam 3 buku berbeda
    ! 3. Hitung Jumlah Buku yg sedang dipinjam  
*/



function updateCheckboxStyles(a=0) {
    $('input[type="checkbox"].flat-red.pilih-buku-individu').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });

    //? Update checked count
    checkedCount = $('input.flat-red.pilih-buku-individu:checked').length;

    //? Disable checkboxes if the max selections are reached
    checkedCount >= maxSelections ? $('input.flat-red.pilih-buku-individu').not(':checked').iCheck('disable'):$('input.flat-red.pilih-buku-individu').iCheck('enable');
    a >= maxSelections?$('input.flat-red.pilih-buku-individu').not(':checked').iCheck('disable'):$('input.flat-red.pilih-buku-individu').iCheck('enable');

    //? Unbind previous event handlers
    $('input.flat-red.pilih-buku-individu').off('ifChecked ifUnchecked');

    //? Rebind event handlers
    $('input.flat-red.pilih-buku-individu').on('ifChecked', function() {
        checkedCount++;
        checkedCount >= maxSelections ? $('input.flat-red.pilih-buku-individu').not(':checked').iCheck('disable'):'';
        let id = $(this).data('id');
        // cekBukuDipinjam(id);
       // ? htmlBukuDipilih(id)
        // console.log(cek)
        ajax_validasi_buku(id);
    });

    $('input.flat-red.pilih-buku-individu').on('ifUnchecked', function() {
        checkedCount--;
        checkedCount < maxSelections?$('input.flat-red.pilih-buku-individu').iCheck('enable'):'';   
        let id = $(this).data('id');
        $('#'+id).remove()
    });
    checkedCount = a
}

updateCheckboxStyles(checkedCount);
tableBook.on('draw', function() {
    updateCheckboxStyles(checkedCount);
});

function htmlBukuDipilih(id){
    // const book = getAjaxOneBook(id);
    // console.log(book)
    $.ajax({
        url: url+'Peminjaman/getAjaxOneBook',
        method: 'POST',
        data:{kd_buku:id},
        dataType: 'json',
        success: function(response) {
            $('.box-terpilih').append(`<div id="${id}">
                <div class="col-lg-4" >
                    <img src="${url}assets/dist/img/buku/${response.foto}" alt="" width="150" height="200">
                    <input type="hidden" value="${id}" name="${id}">
                </div>
            </div>`);   
        }
    })
    
}

function ajax_validasi_buku(id){

    // const buku = id
    const anggota = $('.data-kdanggota').data('kdanggota')
    $.ajax({
        url: url+'Peminjaman/cekBukuYangSedangDipinjam',
        method: 'POST',
        data:{kd_buku:id, kd_anggota:anggota},
        dataType: 'json',
        success: function(response) {
            htmlBukuDipilih(id)
            console.log(response)
            // if(response){
            //     $('input.flat-red#' + id).on(':checked').iCheck('disable');
            // }else{
            //     console.log('tidak ada')
            // }
        }
    })
   
}
// function cekBukuDipinjam(id){

//     const buku = id
//     const anggota = $('.data-kdanggota').data('kdanggota')
//     $.ajax({
//         url: url+'Peminjaman/getAjaxPinjam',
//         method: 'POST',
//         data:{kd_buku:id, kd_anggota:anggota},
//         dataType: 'json',
//         success: function(response) {
//             if(response){
//                 $('input.flat-red#' + id).on(':checked').iCheck('disable');
//             }else{
//                 console.log('tidak ada')
//             }
//         }
//     })
   
// }