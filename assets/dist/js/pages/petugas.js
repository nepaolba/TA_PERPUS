$(document).ready(function () {
   $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
   })
})
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

$(document).on('click', '#pilih-foto', function () {
   $('#fotoPetugas').trigger('click');
})

$('#fotoPetugas').on('change', function (e) {

   const file = e.target.files[0];
   if (file && file.type.startsWith('image/')) {
      $(this).attr('value', file.name)
      const reader = new FileReader();
      reader.onload = function (e) {
         $('#imagePreview img').attr('src', e.target.result).attr('alt', 'thumbnail');
      }
      reader.readAsDataURL(file);
   }
   else {
      $('#fotoPetugas').attr('value', '')
   }
});

$('#formUbahPetugas').validate({
   rules: {
      nama_petugas: {
         required: true,
      },
      jk_petugas: {
         required: true,
      },
      alamat_petugas: {
         required: true,
      },
      nohp_petugas: {
         required: true,
         number: true,
      },
      username: {
         required: true,
      },
   },
   messages: {
      nama_petugas: {
         required: "Nama petugas harus diisi.",
      },
      jk_petugas: {
         required: "Pilih jenis kelamin.",
      },
      alamat_petugas: {
         required: "Alamat harus diisi.",
      },
      nohp_petugas: {
         required: "Nomor HP harus diisi.",
         number: "Masukkan nomor yang valid.",
      },
      username: {
         required: "Username harus diisi.",
      },
   },
   errorElement: 'small',
   errorClass: 'text-danger',
   highlight: function (element) {
      $(element).closest('.form-group').addClass('has-error');
   },
   unhighlight: function (element) {
      $(element).closest('.form-group').removeClass('has-error');
   },
   submitHandler: function (form) {
      // Lakukan tindakan yang diperlukan setelah validasi berhasil
      form.submit(); // Submit formulir secara manual
   }
});