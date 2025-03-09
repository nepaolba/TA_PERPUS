const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
 });
 const flash = $('#flash').data('flash');
 const flashClass = $('#flash').data('class');
 flash ? flashClass == "error" ? notif(flash, flashClass) : notif(flash, flashClass) : '';

 function notif(Fnotif, Fclass) {
    Toast.fire({
       icon: Fclass,
       title: Fnotif
    })
 }


 // tombol pilih foto diklik
//  $('#pilih-foto').on('click', function () {
//     $('#fotoBuku').trigger('click')
//  })

//  $('#fotoBuku').on('change', function(e) {
//     const file = e.target.files[0];
//     if(file){
// console.log(file)
//     }else{
//         console.log('tidak ada file yg dipilih')
//     }
//  })

//  $('#fotoBuku').on('change', function (e) {
//     const file = e.target.files[0];
//     if (file && file.type.startsWith('image/')) {
//        $(this).attr('value', file.name)
//        const reader = new FileReader();
//        reader.onload = function (e) {
//           $('#imagePreview img').attr('src', e.target.result).attr('alt', 'thumbnail');
//        }
//        reader.readAsDataURL(file);
//     }
//     else {
//        $('#fotoBuku').attr('value', '')
//     }
//  });
