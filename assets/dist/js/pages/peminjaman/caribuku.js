let maxSelections = 3;
let checkedCount = 0;
let checkedStatus = {};
const url = $(document)[0].location.origin +"/perpus/";
let tableBook = $('#daftar-buku').DataTable({
    language: {
        search: ""
    },
    pageLength: 25,
    ordering: false,
});

$('.dataTables_filter input')
.attr('placeholder', 'Cari data buku...')
    .css({
        'width': '700px',
        'border': '2px solid rgba(0, 172, 214, 0.35)',
        'border-radius': '10px'
    })
    .removeClass('input-sm')
    .addClass('input-lg');


















    
    // $('input[type="checkbox"].flat-red.pilih-buku-individu').iCheck({
    //     checkboxClass: 'icheckbox_square-blue',
    //     radioClass: 'iradio_square-blue',
    //     increaseArea: '20%'
    // });

// function updateCheckboxStyles(a=0) {
//     $('input[type="checkbox"].flat-red.pilih-buku-individu').iCheck({
//         checkboxClass: 'icheckbox_square-blue',
//         radioClass: 'iradio_square-blue',
//         increaseArea: '20%'
//     });
// }

    



//     //? Update checked count
//     checkedCount = $('input.flat-red.pilih-buku-individu:checked').length;
//     //? Disable checkboxes if the max selections are reached
//     checkedCount >= maxSelections ? $('input.flat-red.pilih-buku-individu').not(':checked').iCheck('disable'):$('input.flat-red.pilih-buku-individu').iCheck('enable');
//     a >= maxSelections?$('input.flat-red.pilih-buku-individu').not(':checked').iCheck('disable'):$('input.flat-red.pilih-buku-individu').iCheck('enable');
//     //? Unbind previous event handlers
//     $('input.flat-red.pilih-buku-individu').off('ifChecked ifUnchecked');
//     //? Rebind event handlers
//     $('input.flat-red.pilih-buku-individu').on('ifChecked', function() {
//         checkedCount++;
//         checkedCount >= maxSelections ? $('input.flat-red.pilih-buku-individu').not(':checked').iCheck('disable'):'';
//         let id = $(this).data('id');
//         // cekBukuDipinjam(id);
//         // ? htmlBukuDipilih(id)
//         // console.log(cek)
//          ajax_validasi_buku(id);
        
//     });

//     $('input.flat-red.pilih-buku-individu').on('ifUnchecked', function() {
//         checkedCount--;
//         checkedCount < maxSelections?$('input.flat-red.pilih-buku-individu').iCheck('enable'):'';   
//         let id = $(this).data('id');
//         $('#'+id).remove()
//     });
//     checkedCount = a
// }

// updateCheckboxStyles(checkedCount);
// tableBook.on('draw', function() {
//     updateCheckboxStyles(checkedCount);
// });


// function htmlBukuDipilih(id){
//     $.ajax({
//         url: url+'Peminjaman/getAjaxOneBook',
//         method: 'POST',
//         data:{kd_buku:id},
//         dataType: 'json',
//         success: function(response) {
//             $('.box-terpilih').append(`<div id="${id}">
//                 <div class="col-lg-4" >
//                     <img src="${url}assets/dist/img/buku/${response.foto}" alt="" width="150" height="200">
//                     <input type="hidden" value="${id}" name="${id}">
//                 </div>
//             </div>`);   
//         }
//     })
    
// }



// function ajax_validasi_buku(id){

//     // const buku = id
//     const anggota = $('.data-kdanggota').data('kdanggota')
//     $.ajax({
//         url: url+'Peminjaman_Individu/cek_buku_sedang_dipinjam',
//         method: 'POST',
//         data:{kd_buku:id, kd_anggota:anggota},
//         dataType: 'json',
//         success: function(response) {
//             htmlBukuDipilih(id)
//             console.log(response);
//             if(response.status == 'lolos') {
//                 // Jika peminjaman lolos, lakukan sesuatu atau biarkan radio tercentang
//                 alert('Peminjaman diperbolehkan.');
//             } else {
//                 // Jika tidak lolos, uncheck radio button dan tampilkan pesan
//                 alert('Peminjaman tidak diperbolehkan.');
//                 // console.log($('input[type="checkbox"].flat-red.pilih-buku-individu#'+id));
//                 $('input[type="checkbox"].flat-red.pilih-buku-individu#'+id).iCheck('uncheck');
//             }
//             // console.log($('#'+id).parent().toggle('.checked'))
//             // if(response){
//             //     $('input.flat-red#' + id).on(':checked').iCheck('disable');
//             // }else{
//             //     console.log('tidak ada')
//             // }
//         }
//     })
   
// }

// // console.log($('.flat-red.pilih-buku-individu'));