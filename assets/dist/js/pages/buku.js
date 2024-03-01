(function ($) {
   $('#example1').DataTable({
      'paging': false,
      'lengthChange': false,
      'searching': false,
      'ordering': false,
      'info': false,
      'autoWidth': false
   });

   $('#example2').DataTable();
   $('.select2').select2();
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
   $('#pilih-foto').on('click', function () {
      $('#fotoBuku').trigger('click')
   })

   $('#fotoBuku').on('change', function (e) {
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
         $('#fotoBuku').attr('value', '')
      }
   });

   $("#formBuku").validate({
      rules: {
         kd_kategori: { required: true },
         judul_buku: { required: true },
         penulis: { required: true },
         penerbit: { required: true },
         tahun_terbit: { required: true, integer: true, min: 1, minlength: 4, maxlength: 4, range: [1900, 2100] },
         jumlah_buku: { required: true, integer: true, min: 1 },
         id_rak: { required: true },
      },
      messages: {
         kd_kategori: "<i class='fa fa-times-circle'></i> Pilih kategori buku",
         judul_buku: "<i class='fa fa-times-circle'></i> Masukkan judul buku",
         penulis: "<i class='fa fa-times-circle'></i> Masukkan nama penulis",
         penerbit: "<i class='fa fa-times-circle'></i> Masukkan nama penerbit",
         tahun_terbit: {
            required: "<i class='fa fa-times-circle'></i> Masukkan tahun terbit",
            integer: "<i class='fa fa-times-circle'></i> Masukkan hanya angka",
            min: "<i class='fa fa-times-circle'></i> Jumlah Buku harus lebih dari 0",
            minlength: "<i class='fa fa-times-circle'></i> Tahun Harus memeliki 4 digit",
            maxlength: "<i class='fa fa-times-circle'></i> Tahun Harus memeliki 4 digit",
            range: "<i class='fa fa-times-circle'></i> Masukan tahun antara 1900 - 2100",
         },
         jumlah_buku: {
            required: "<i class='fa fa-times-circle'></i> Masukkan jumlah buku",
            integer: "<i class='fa fa-times-circle'></i> Masukkan hanya angka",
            min: "<i class='fa fa-times-circle'></i> Tahun Terbit harus lebih dari 0"
         },
         id_rak: "<i class='fa fa-times-circle'></i> Pilih rak buku",
         foto: {
            required: "<i class='fa fa-times-circle'></i> Pilih foto",
            extension: "<i class='fa fa-times-circle'></i> Format file tidak valid (jpg, jpeg, png, gif)"
         }
      },
      errorPlacement: function (error, element) {
         element.is("select") && element.hasClass("select2") ? error.insertAfter(element.next()) : error.insertAfter(element);
         error.addClass("text-danger small");
      },
      highlight: function (element, errorClass, validClass) {
         $(element).addClass("is-invalid");
      },
      unhighlight: function (element, errorClass, validClass) {
         $(element).removeClass("is-invalid");
      },
      submitHandler: function (form) {
         form.submit();
      }
   });
   $('select.select2').on('change', function () {
      $(this).siblings().eq(2).hide()
   });









   // $(document).on('click', '.btn-edit', function () {
   //    const id = $(this).data('id');
   //    $('#frm-edit' + id).on('submit', function (e) {
   //       e.preventDefault();
   //       const kategori = $(this)[0][0];
   //       console.log(kategori.value == "")
   //       if (kategori.value == "") {
   //          $(".fg" + id).addClass('has-error')
   //       } else {
   //          this.submit()
   //       }
   //    })
   // })
}(jQuery));






//    const Toast = Swal.mixin({
//       toast: true,
//       position: 'top-end',
//       showConfirmButton: false,
//       timer: 3000
//    });
//    const flash = $('#flash').data('flash');
//    const flashClass = $('#flash').data('class');
//    flash ? flashClass == "error" ? notif(flash, flashClass) : notif(flash, flashClass) : '';

//    function notif(Fnotif, Fclass) {
//       Toast.fire({
//          icon: Fclass,
//          title: Fnotif
//       })
//    }







//    $(document).ready(function () {
//       // Inisialisasi jQuery Validation
//       $("#formBuku").validate({
//          rules: {
//             kd_kategori: "required",
//             judul_buku: "required",
//             penulis: "required",
//             penerbit: "required",
//             tahun_terbit: {
//                required: true,
//                digits: true
//             },
//             foto: "required",
//             jumlah_buku: {
//                required: true,
//                digits: true
//             },
//             id_rak: "required"

//          },
//          messages: {
//             kd_kategori: "Pilih kategori buku",
//             judul_buku: "Masukkan judul buku",
//             penulis: "Masukkan nama penulis",
//             penerbit: "Masukkan nama penerbit",
//             tahun_terbit: {
//                required: "Masukkan tahun terbit",
//                digits: "Masukkan hanya angka"
//             },
//             jumlah_buku: {
//                required: "Masukkan jumlah buku",
//                digits: "Masukkan hanya angka"
//             },
//             id_rak: "Pilih rak buku",
//             foto: {
//                required: "Pilih foto",
//                extension: "Format file tidak valid (jpg, jpeg, png, gif)"
//             }
//          },
//          errorPlacement: function (error, element) {
//             if (element.is("select") && element.hasClass("select2")) {
//                // Pindahkan pesan kesalahan di bawah elemen <select>

//                error.insertAfter(element.next());
//             } else {
//                // Biarkan pesan kesalahan di atas elemen lainnya
//                error.insertAfter(element);
//             }
//             error.addClass("text-danger small");
//          },

//          highlight: function (element, errorClass, validClass) {
//             $(element).addClass("is-invalid");
//          },
//          unhighlight: function (element, errorClass, validClass) {
//             $(element).removeClass("is-invalid");
//          },
//          submitHandler: function (form) {
//             // Logika yang akan dijalankan setelah validasi sukses
//             // Misalnya, tampilkan pesan sukses atau kirim formulir ke server
//             form.submit();
//          }
//       });
//    });



//    // $('#foto').on('change', function (e) {
//    //    const file = e.target.files[0];
//    //    if (file && file.type.startsWith('image/')) {
//    //       // $('#foto').attr('value', file.name)
//    //       const reader = new FileReader();
//    //       reader.onload = function (e) {
//    //          $('#image-preview img').attr('src', e.target.result).attr('alt', 'thumbnail');
//    //       }
//    //       reader.readAsDataURL(file);
//    //    } else {
//    //       $('#foto').attr('value', '')
//    //    }
//    // })



//    $(document).on('click', "#foto", function () {
//       $('#upload').trigger('click');
//    })

//    $(document).on('click', ".btn-select", function () {
//       $('#upload').trigger('click');
//    })

//    $('#upload').on('change', function (e) {

//       const file = e.target.files[0];
//       if (file && file.type.startsWith('image/')) {
//          $('#foto').attr('value', file.name)
//          const reader = new FileReader();
//          reader.onload = function (e) {
//             $('#image-preview img').attr('src', e.target.result).attr('alt', 'thumbnail');
//          }
//          reader.readAsDataURL(file);
//       }
//       else {
//          $('#foto').attr('value', '')
//       }
//    })






//    // $(document).on('click', "#text-foto", function () {
//    //    $('#foto').trigger('click');
//    // })



//    // $("#frmAddBook").validate({
//    //    rules: {
//    //       kd_kategori: "required",
//    //       judul_buku: "required",
//    //       penulis: "required",
//    //       isbn: "required",
//    //       penerbit: "required",
//    //       tahun_terbit: {
//    //          required: true,
//    //          digits: true,
//    //          minlength: 4,
//    //          maxlength: 4,
//    //          min: 1000,
//    //          max: 9999
//    //      },
//    //       jumlah_buku: {
//    //           required: true,
//    //           digits: true
//    //       },
//    //       id_rak: "required",
//    //       foto: {
//    //          required: "required",
//    //          accept: "image/*" // Menetapkan tipe file sebagai gambar
//    //      }
//    //   },
//    //   messages: {
//    //       kd_kategori: "Pilih kategori buku",
//    //       judul_buku: "Masukkan judul buku",
//    //       penulis: "Masukkan nama penulis",
//    //       isbn: "Masukkan ISBN",
//    //       penerbit: "Masukkan penerbit",
//    //       tahun_terbit: {
//    //          required: "Masukkan tahun terbit",
//    //          digits: "Masukkan tahun dengan format angka",
//    //          minlength: "Masukkan 4 digit tahun",
//    //          maxlength: "Masukkan 4 digit tahun",
//    //          min: "Tahun harus lebih dari 1000",
//    //          max: "Tahun harus kurang dari 9999"
//    //      },
//    //       jumlah_buku: {
//    //          required: "Masukkan jumlah buku",
//    //          digits: "Masukkan hanya angka"
//    //       },
//    //       id_rak: "Pilih rak buku",
//    //       foto: {
//    //          required: "Pilih foto buku",
//    //          accept: "File harus berupa gambar"
//    //      }
//    //    },
//    //    errorElement: "small",
//    //    errorPlacement: function(error, element) {
//    //       if(element.is("select") && element.hasClass("select2")){
//    //           error.insertAfter(element.next())
//    //       }else{
//    //          error.insertAfter(element);
//    //       }
//    //       // console.log($("input-group"))
//    //       error.addClass("text-danger");
//    //    }

//    // });


//    // $('#foto').on('change', function (e) {
//    //    const file = e.target.files[0];
//    //    if (file && file.type.startsWith('image/')) {
//    //       $('#text-foto').attr('value', file.name)
//    //       const reader = new FileReader();
//    //       reader.onload = function (e) {
//    //          const thumbnail = '<div class="thumbnail"><img src="' + e.target.result + '" alt="thumbnail"> </div>';
//    //          $('#img-preview').html(thumbnail)
//    //       }
//    //       reader.readAsDataURL(file);
//    //    } else {
//    //       $('#foto').attr('value', '')
//    //    }
//    // })


//    // const selectImage = document.querySelector('.select-image');
//    // const inputFile = document.querySelector('#file');
//    // const imgArea = document.querySelector('.image-area');

//    // selectImage.addEventListener('click', function () {
//    // 	inputFile.click();
//    // })

//    // inputFile.addEventListener('change', function () {
//    // 	const image = this.files[0]
//    // 	if(image.size < 2000000) {
//    // 		const reader = new FileReader();
//    // 		reader.onload = ()=> {
//    // 			const allImg = imgArea.querySelectorAll('img');
//    // 			allImg.forEach(item=> item.remove());
//    // 			const imgUrl = reader.result;
//    // 			const img = document.createElement('img');
//    // 			img.src = imgUrl;
//    // 			imgArea.appendChild(img);
//    // 			imgArea.classList.add('active');
//    // 			imgArea.dataset.img = image.name;
//    // 		}
//    // 		reader.readAsDataURL(image);
//    // 	} else {
//    // 		alert("Image size more than 2MB");
//    // 	}
//    // })
// })