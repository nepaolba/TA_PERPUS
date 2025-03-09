const url = $(document)[0].location.origin +"/perpus/";
$('#daftarAnggota').DataTable();


$('.dataTables_filter input').css('width', '300px');




$.fn.datepicker.dates["id"] = {
	days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
	daysShort: ["Mgu", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
	daysMin: ["Mg", "Sn", "Sl", "Ra", "Ka", "Ju", "Sa"],
	months: [
		"Januari",
		"Februari",
		"Maret",
		"April",
		"Mei",
		"Juni",
		"Juli",
		"Agustus",
		"September",
		"Oktober",
		"November",
		"Desember",
	],
	monthsShort: [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Ags",
		"Sep",
		"Okt",
		"Nov",
		"Des",
	],
	today: "Hari Ini",
	clear: "Kosongkan",
};


$('input[type="radio"].flat-red.pilih-pj').iCheck({
    radioClass   : 'iradio_flat-green',
	radioClass: "iradio_flat-green",
}).on('ifChecked', function(event){	
    // const selectedValue = $(this).val();
    // $('#pj').val(selectedValue);
	// console.log('oo');
})

const today = new Date();
const formattedDate =
	String(today.getDate()).padStart(2, "0") +
	"/" +
	String(today.getMonth() + 1).padStart(2, "0") +
	"/" +
	today.getFullYear();
$("#peminjaman").DataTable({
	paging: true,
	lengthChange: true,
	searching: true,
	ordering: false,
	info: true,
	autoWidth: true,
});

// $('input[type="radio"].flat-red').iCheck({
// 	radioClass: "iradio_flat-green",
// });
const Toast = Swal.mixin({
	toast: true,
	position: "top-end",
	showConfirmButton: false,
	timer: 3000,
});
const flash = $("#flash").data("flash");
const flashClass = $("#flash").data("class");
flash
	? flashClass == "error"
		? notif(flash, flashClass)
		: notif(flash, flashClass)
	: "";

function notif(Fnotif, Fclass) {
	Swal.fire({
		title: Fclass,
		text: Fnotif,
		icon: Fclass
	  });
}

typeForm("individu");
$("#input-box").html(htmlInputIndividu); // memangil fungsi htmlinput individu saat halaman dimuat pertama kali
eventClickJenisPeminjaman("individu"); // jika klik jenis peminjaman individu
eventClickJenisPeminjaman("kelompok"); // jika klik jenis peminjaman kelompok
fetchData(url + "Peminjaman/getAjaxAllKategori", "GET", optionKategori); //ambil data kategori
fetchData(url + "Peminjaman/getAjaxAllAnggota", "GET", optionAnggota);
fetchData(url + "Peminjaman/getAjaxAllBook", "GET", optionBuku);
eventChange(url + "Peminjaman/getAjaxBook/", "#kd_kategori", "optionsBuku");
eventChange(url + "Anggota/getAjaxAnggota/", "#kd_anggota", "detailAnggota");
eventChange(url + "Peminjaman/getBookDetails/", "#kd_buku", "detailBuku");
$("#datepicker").datepicker({
	language: "id",
	autoclose: true,
	format: "dd/mm/yyyy",
	todayHighlight: true,
});
$(".select2").select2();
$("select.select2").on("change", function () {
	$(this).siblings().eq(2).hide();
});

$("#datepicker").val(formattedDate);
jQuery.validator.addMethod(
	"dateDDMMYYYY",
	function (value, element) {
		return /^\d{2}\/\d{2}\/\d{4}$/.test(value);
	},
	"<i class='fa fa-times-circle'></i> Format tanggal harus dd/mm/yyyy"
);
$.validator.setDefaults({ dateFormat: "dd/mm/yyyy" });

$.validator.addMethod(
	"cekStok",
	function (value, element) {
		const stok = $(element).data("stok"); // Ambil nilai stok dari atribut data-stok
		return parseInt(value) <= stok; // Kembalikan true jika jumlah pinjam kurang dari atau sama dengan stok
	},
	"<i class='fa fa-times-circle'></i> Stok buku tidak mencukupi"
);

$.validator.addMethod(
	"cekStokIndividu",
	function (value, element) {
		const stokIndividu = $(element).data("stok-individu"); // Ambil nilai stok dari atribut data-stok
		return $("#addPinjam").data("type-form") === "kelompok"
			? true
			: 1 <= parseInt(stokIndividu);
	},
	"Stok buku tidak mencukupi"
);

function typeForm(type) {
	$("#addPinjam").attr("data-type-form", type).data("type-form", type);
}

function fetchData(url, method, successCallback) {
	$.ajax({
		url: url,
		method: method,
		success: successCallback,
	});
}

function optionKategori(response) {
	const arrayKategori = JSON.parse(response);
	let option = "";
	arrayKategori.forEach((element) => {
		option +=
			'<option value="' +
			element.kd_kategori +
			'">' +
			element.kategori +
			"</option>";
	});
	$("#kd_kategori").html('<option value="">Pilih Kategori</option>' + option);
}

function optionBuku(response) {
	const arrayBook = JSON.parse(response);
	let dataBook = "";
	arrayBook.forEach((element) => {
		dataBook +=
			'<option value="' +
			element.kd_buku +
			'">' +
			element.judul_buku +
			"</option>";
	});
	$("#kd_buku").html('<option value="">Pilih Buku</option>' + dataBook);
}

function optionAnggota(response) {
	const arrayAnggota = JSON.parse(response);
	let option = "";
	arrayAnggota.forEach((element) => {
		option +=
			'<option value="' +
			element.kd_anggota +
			'">' +
			element.kd_anggota +" - "+element.nama_anggota +
			"</option>";
	});
	$("#kd_anggota").html('<option value="">Pilih Anggota</option>' + option);
}

function eventChange(url, targgetEvent, typeOption) {
	$(targgetEvent).on("change", function () {
		const data = $(this).val();
		targgetEvent === "#kd_kategori" && $(this).val() === ""
			? fetchData("getAjaxAllBook", "GET", optionBuku)
			: "";
		data && typeOption === "detailAnggota"
			? fetchData(url + data, "GET", detailAnggota)
			: "";
		data && typeOption === "optionsBuku"
			? fetchData(url + data, "GET", optionBuku)
			: "";
		data && typeOption === "detailBuku"
			? fetchData(url + data, "GET", detailBuku)
			: "";
		data === "" && typeOption === "detailAnggota"
			? $(".detail-anggota").html("")
			: "";
		data === "" && typeOption === "detailBuku"
			? $(".detail-book").html("")
			: "";
		typeOption === "optionsBuku" ? $(".detail-book").html("") : "";
		// (targgetEvent==="#kd_anggota" && $('#addPinjam').data('type-form') == 'individu') ? cekPeminjamanAnggota($(this).val()):"";
	});
}

//  function cekPeminjamanAnggota(kd_anggota){
//    // console.log(kd_anggota)
//    fetchData('getAjaxPeminjam/'+kd_anggota, "GET", hasilCekPeminjamanAnggota)
//  }

// function hasilCekPeminjamanAnggota(response){
//    console.log(response);

// }
// $.validator.addMethod("cekPeminjam", function (value, element) {
//    const stok = $(element).data('stok'); // Ambil nilai stok dari atribut data-stok
//    return parseInt(value) <= stok; // Kembalikan true jika jumlah pinjam kurang dari atau sama dengan stok
// }, "<i class='fa fa-times-circle'></i> Anda belum mengembalikan buku");

function eventClickJenisPeminjaman(type) {
	$("label[for=" + type + "],label[for=" + type + "] .iCheck-helper").on(
		"click",
		function () {
			typeForm(type);
			type == "kelompok" ? $("#input-box").html(htmlInputKelompok) : "";
			type == "individu" ? $("#input-box").html(htmlInputIndividu) : "";
			fetchData(url + "Peminjaman/getAjaxAllKategori", "GET", optionKategori); //ambil data kategori
			fetchData(url + "Peminjaman/getAjaxAllAnggota", "GET", optionAnggota);
			fetchData(url + "Peminjaman/getAjaxAllBook", "GET", optionBuku);
			eventChange(
				url + "Peminjaman/getAjaxBook/",
				"#kd_kategori",
				"optionsBuku"
			);
			eventChange(
				url + "Anggota/getAjaxAnggota/",
				"#kd_anggota",
				"detailAnggota"
			);
			eventChange(url + "Peminjaman/getBookDetails/", "#kd_buku", "detailBuku");
			$("#datepicker").datepicker({
				language: "id",
				autoclose: true,
				format: "dd/mm/yyyy",
				todayHighlight: true,
			});
			$(".timepicker").timepicker({
				showInputs: false,
				defaultTime: new Date(),
				showMeridian: false,
				minuteStep: 1,
			});
			$(".select2").select2();
			$(".datepicker").hide();
			$(".detail-anggota").html("");
			$(".detail-book").html("");
			$("select.select2").on("change", function () {
				$(this).siblings().eq(2).hide();
			});
		}
	);
}

function detailBuku(response) {
	const urlImg = $(".detail-book").data("img");
	const book = JSON.parse(response);
	$(".detail-book").html(
		`<tr><td><img src="${urlImg}${book.foto}" width="150" alt="buku" style="border:5px solid #80808042;border-radius:5px;padding:2px"><br><br></td></tr>
         <tr><td>Judul Buku</td><th class="text-center" width="20"> : </th><td>${book.judul_buku}</td></tr>
         <tr><td>Pengarang</td><th class="text-center" width="20"> : </th><td>${book.penulis}</td></tr>
         <tr><td>Penerbit</td><th class="text-center" width="20"> : </th><td>${book.penerbit}</td></tr>
         <tr><td>Tahun Terbit</td><th class="text-center" width="20"> : </th><td>${book.tahun_terbit}</td></tr>
         <tr><td>ISBN</td><th class="text-center" width="20"> : </th><td>${book.isbn}</td></tr>
         <tr><td>Jumlah Buku</td><th class="text-center" width="20"> : </th><td>${book.jumlah_buku}</td></tr>
         <tr><td>Kategori Buku</td><th class="text-center" width="20"> : </th><td>${book.kategori}</td></tr>
         <tr><td>Rak Buku</td><th class="text-center" width="20"> : </th><td>${book.nama_rak}</td></tr>
         <tr><td>Dipinjam</td><th class="text-center" width="20"> : </th><td>${book.jumlah_dipinjam}</td></tr>
         <tr><td>Tersedia</td><th class="text-center" width="20"> : </th><td><small class="label label-info"> ${book.sisa_stok} Stok Buku</small></td></tr>`
	);
	$("#jumlah_pinjam").add().attr("data-stok", book.sisa_stok);
	$("#kd_buku")
		.attr("data-stok-individu", book.sisa_stok)
		.data("stok-individu", book.sisa_stok);
}

$("#addPinjam").validate({
	rules: {
		kd_buku: { required: true, cekStokIndividu: true },
		nis_nip: {
			required: true,
			remote: {
				url: "getAjaxPeminjam",
				type: "post",
				data: {
					type: function () {
						return $("#addPinjam").data("type-form");
					},
					kd_buku: function (r) {
						// console.log(r);
						return $("#kd_buku").val();
					},
					kd_anggota: function () {
						return $("#kd_anggota").val();
					},
				},
			},
		},
		kelas: { required: true },
		jumlah_pinjam: { required: true, number: true, min: 1, cekStok: true },
		waktu: { required: true, time: true },
		tgl_kembali: { required: true, dateDDMMYYYY: true },
	},
	messages: {
		kd_buku: {
			required: "<i class='fa fa-times-circle'></i> Pilih Judul Buku",
			cekStokIndividu:
				"<i class='fa fa-times-circle'></i> Stok buku tidak mencukupi atau 0",
		},
		nis_nip: {
			required: "<i class='fa fa-times-circle'></i> Pilih Nama Anggota",
			remote: "<i class='fa fa-times-circle'></i> Buku Belum dikembalikan",
		},
		waktu:
			"<i class='fa fa-times-circle'></i> Masukkan format waktu yang benar",
		kelas: "<i class='fa fa-times-circle'></i> Masukkan kelas",
		jumlah_pinjam: {
			required: "<i class='fa fa-times-circle'></i> Masukkan Jumlah Pinjam",
			number: "<i class='fa fa-times-circle'></i> Masukkan Angka",
			min: "<i class='fa fa-times-circle'></i> Jumlah pinjam harus lebih dari 0",
		},
		tgl_kembali: {
			required:
				"<i class='fa fa-times-circle'></i> Masukkan tanggal pengembalian",
			date: "<i class='fa fa-times-circle'></i> Masukkan format tanggal yang valid",
		},
	},
	errorPlacement: function (error, element) {
		element.is("select") && element.hasClass("select2")
			? error.insertAfter(element.next(".select2-container"))
			: error.insertAfter(element);
	},
	submitHandler: function (form) {
		form.submit();
	},
});

function htmlInputIndividu() {
	return `
	<input name="jenis_pinjam" style="display:none" value="0">
	<div class="form-group"><label for="kd_kategori">Kategori</label><select id="kd_kategori" class="form-control select2" style="width: 100%;"><option value="">Pilih Kategori</option></select></div>
         <div class="form-group"><label for="kd_buku">Buku</label><select name="kd_buku" id="kd_buku" class="form-control select2" style="width: 100%;"><option value="">Pilih Buku</option></select></div>
         <div class="form-group"><label for="kd_anggota">Nama Anggota</label><select name="nis_nip" id="kd_anggota" class="form-control select2" style="width: 100%;"><option value="">Pilih Anggota</option></select></div>
         <div class="form-group"><label for="datepicker">Tanggal Pengembalian</label><input type="text" name="tgl_kembali" class="form-control" id="datepicker" autocomplete="off"></div>`;
}

function htmlInputKelompok() {
	return `<input name="jenis_pinjam" style="display:none" value="1"><div class="form-group"><label for="kd_kategori">Kategori</label><select id="kd_kategori" class="form-control select2" style="width: 100%;">   <option value="">Pilih Kategori</option></select></div>
         <div class="form-group"><label for="kd_buku">Buku</label><select name="kd_buku" id="kd_buku" class="form-control select2" style="width: 100%;">   <option value="">Pilih Buku</option></select></div>
         <div class="form-group"><label for="kd_anggota">Penangung jawab</label><select name="nis_nip" id="kd_anggota" class="form-control select2" style="width: 100%;">   <option value="">Pilih Anggota</option></select></div> 
         <div class="form-group"><label for="kelas">Kelas</label><input type="text" name="kelas" id="kelas" class="form-control"  placeholder="Masukan Kelas"></div>
         <div class="form-group"><label for="jumlah_pinjam">Jumlah Peminjaman</label><input type="text" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control" placeholder="Masukan jumlah peminjaman"></div>
         <div class="bootstrap-timepicker"><div class="form-group">   <label for="waktu">Jam Pengembalian</label>   <input type="text" name="waktu"  id="waktu" class="form-control timepicker" autocomplete="off"></div></div> `;
}

function detailAnggota(response) {
	const arrayAnggota = JSON.parse(response);
	$(".detail-anggota").html(
		`<tr>
			<td>Nama Lengkap</td>
			<th class="text-center" width="20"> : </th>
			<td>${arrayAnggota.nama_anggota}</td>
		</tr>
        <tr>
			<td>NIP/NIS</td>
			<th class="text-center" width="20"> : </th>
			<td>${arrayAnggota.kd_anggota}</td>
		</tr>
        <tr>
			<td>Jenis Kelamin</td>
			<th class="text-center" width="20"> : </th>
			<td>${arrayAnggota.jk == "0" ? "Laki-laki" : "Perempuan"}</td>
		</tr>
         <tr>
			<td>No HP</td>
			<th class="text-center" width="20"> : </th>
			<td>${arrayAnggota.alamat}</td>
		</tr>
         <tr>
			<td>Jenis Kelamin</td>
			<th class="text-center" width="20"> : </th>
			<td>${arrayAnggota.nohp}</td>
		</tr>
        <tr>
			<td>Status</td>
			<th class="text-center" width="20"> : </th>
			<td>${arrayAnggota.status == "0" ? "Guru" : "Siswa"}</td>
		</tr>`
	);
}









$('#frm-cari-anggota').on('submit', function(event){
	event.preventDefault();
	const id = $(this).serialize();
	// console.log(url)
	$.ajax({
		url:url + 'Anggota/getAjaxAnggotaById',
		type: 'POST',
		data:id,
		dataType:"JSON",
		success: function(response) {	
			const htmlAnggotaIndividu = `
			<td>${response.kd_anggota}</td>
			<td>${response.nama_anggota}</td>
			<td>${response.jk == 0 ? "Laki-Laki":"Perempuan"}</td>
			<td>${response.alamat}</td>
			<td>
				<div class="form-group">
					<label>
						<input type="checkbox" class="flat-red pilih-anggota" id="${response.kd_anggota}">
						Pilih
					</label>
				</div>
			</td>`;			
			$('#tabel-cari-anggota-individu>tbody>tr').html(htmlAnggotaIndividu);
			$('input[type="checkbox"].flat-red.pilih-anggota').iCheck({
				checkboxClass: 'icheckbox_flat-green',
				radioClass   : 'iradio_flat-green'
			}).on('ifChecked', function(event){	
				window.location.href = "cek_jumlah_peminjaman_individu/"+$(this).attr('id');
			})
		}
	})
})

$('#frm-cari-buku-individu').on('submit', function(event){
	event.preventDefault();
	const keyword = $(this).serialize();
	const keywordObject = Object.fromEntries(new URLSearchParams(keyword));
	if (keywordObject.keyword){
		$.ajax({
			url:url + 'Buku/cariBuku',
			type: 'POST',
			data:keyword,
			dataType:"JSON",
			success: function(response) 
			{
				let htmlBukuAnggotaIndividu ="";
				let i = 1;
				response.forEach(element => {
					htmlBukuAnggotaIndividu += `
						<tr>
						<td>
							<div class="form-group">
								<label>
									<input type="checkbox" class="flat-red pilih-buku-individu" id="${element.kd_buku}" >
									Pilih
								</label>
							</div>
						</td>
							<td>
								<div class="buku d-flex justify-content-center">
									<img src="${url+"assets/dist/img/buku/"+element.foto}" class="image-fluid" width="100" height="100" alt="">
								</div>
							</td>
							<td>
								<h5>${element.judul_buku}</h5>
								<p>PENULIS : ${element.penulis}</p>
							</td>
							<td>${element.penerbit}</td>
							<td>${element.kategori}</td>
							<td>${element.nama_rak}</td>
							<td>${element.sisa_stok}</td>
							
						</tr>`;
				});
				// console.log(htmlBukuAnggotaIndividu);
				$("#table-cari-buku-individu>tbody").html(htmlBukuAnggotaIndividu); 
				$('input[type="checkbox"].flat-red.pilih-buku-individu').iCheck({
					checkboxClass: 'icheckbox_flat-green',
					radioClass   : 'iradio_flat-green'
				}).on('ifChecked', function(e){	
					const path = window.location.pathname
					const segments = path.split("/")
					// window.location.href= url+ 'Peminjaman/submitPeminjamanIndividu/'+segments[4]+"/"+$(this).attr('id');
					// const cek = cekPeminjamanIndividu(segments[4], $(this).attr('id'));
					window.location.href=url+"Peminjaman/cekPeminjamanIndividu/"+segments[4]+"/"+$(this).attr('id')
					// console.log(cek)
					// window.location.href = 'Peminjaman/submitPeminjamanIndividu/'+segments[4]+"/"+$(this).attr('id');
					// $('.konfirmasi-buku-individu').html(`
					// 	<button class="btn btn-lg btn-info btn-block">Konfirmasi</button>
					// `)
				}).on('ifUnchecked', function(e){
					$(".box-terpilih#"+$(this).attr('id')).remove();					
					$(".box-buku-dipilih").children().length<=1 ? $('.konfirmasi-buku-individu').html(""):"";
				})
			}
		});
	}else{
		console.log('silahkan masukan keyword pencarian');
	}
})


$('#btn-simpan').on('click', function(){
	// const today = new Date();
	const path = window.location.pathname;
	const segments = path.split("/");
	// const onWeekLatter = new Date(today.getTime()+ (7*24*60*60*1000));
	// const tgl_jatuh_tempo =	onWeekLatter.getFullYear()+"-" +String(onWeekLatter.getMonth() + 1).padStart(2, "0") +"-" +	String(onWeekLatter.getDate()).padStart(2, "0") +" " + onWeekLatter.getHours()+ ":"+ onWeekLatter.getMinutes()+":"+ onWeekLatter.getSeconds();
	// const tgl_hari_ini = today.getFullYear()+"-" +String(today.getMonth() + 1).padStart(2, "0") +"-" +String(today.getDate()).padStart(2, "0") +" " + today.getHours()+ ":"+ today.getMinutes()+":"+ today.getSeconds();
	const kd_anggota = segments[4];
	const kd_buku = segments[5];
	window.location.href=url+"Peminjaman/simpanPeminjamanIndividu/"+kd_anggota+"/"+ kd_buku
	// $.ajax({
	// 	url:url + 'Peminjaman/simpanPeminjamanIndividu/',
	// 	type: 'POST',
	// 	data:{kd_anggota,kd_buku,tgl_hari_ini,tgl_jatuh_tempo},
	// 	success: function(response) {
	// 		const a = JSON.parse(response)
	// 		if(a =="sukses"){
	// 			window.location.href = url+"/Peminjaman"
	// 		}
	// 		console.log(a)
	// 	}
	// })

})


// function cekPeminjamanIndividu(kd_anggota,kodeBuku){
// 	// console.log(kd_anggota +"-"+kodeBuku)
// 	$.ajax({
// 		url:url + 'Peminjaman/cekPeminjamanIndividu/',
// 		type: 'POST',
// 		data:{kd_anggota,kodeBuku},
// 		success: function(response) {
// 			// const a = JSON.parse(response)
// 			// if(a =="sukses"){
// 			// 	window.location.href = url+"/Peminjaman"
// 			// }
// 			// return a
// 			console.log(response)
// 		}
// 	})
// }





function ajaxBuku(kodeBuku){
	$.ajax({
		url:url + 'Buku/getby_buku_id/'+kodeBuku,
		type: 'POST',
		dataType:"JSON",
		success: function(response) {
			const boxTerpilih = `
			<div class="col-lg-4 box-terpilih" id="${response.kd_buku}">
				<div class="box box-solid new-shadow" style="border:2px solid skyblue">
				<input type="hidden" name="kd_buku${response.kd_buku}" value="${response.kd_buku}" >
					<div class="box-body d-flex">
					<style>
						img{
							object-fit:cover
						}
					</style>
						<img src="${url+"assets/dist/img/buku/"+response.foto}" width="120" height="160" alt="">
						<b style="padding: 20px;">
							${response.judul_buku}
							<br><br>
							<p>sisa stok : ${response.sisa_stok}</p>
						</b>
						<span class="fa fa-2x fa-times-circle-o  "></span>
					</div>
				</div>
			</div>`;
			$('.box-buku-dipilih').append(boxTerpilih)
		}
	})
}










	//     e.preventDefault();





// peminjaman Individu
// baru

// $('#frm-cari-anggota').on('submit', function(e){
//     e.preventDefault();
//     const id = $(this).serialize();
//     $.ajax({
//         url: url + 'Anggota/getAjaxAnggotaById', // Sesuaikan dengan URL endpoint yang benar
//         type: 'POST',
//         data: id,
// 		dataType:"JSON",
//         success: function(response) {		
// 				console.log(response.kd_anggota);
// 				const html = `
// 				<table id="example1" class="table table-bordered table-striped">
// 				<thead>
// 				   <tr>
// 					  <th>NIS/NIP/ID</th>
// 					  <th>Nama Anggota</th>
// 					  <th>Alamat</th>
// 					  <th>Aksi</th>
// 				   </tr>
// 				</thead>
// 				<tbody>
// 				   <tr>
// 					  <td>${response.kd_anggota}</td>
// 					  <td>${response.nama_anggota}</td>
// 					  <td>${response.alamat}</td>
// 					  <td>
// 						 <a href="${url+'Peminjaman/cariBuku/'+response.kd_anggota}" class="btn btn-small btn-info"> <i class="fa fa-check"></i> <small>Pilih</small></a>
// 					  </td>
// 				   </tr>
// 				</tbody>
// 			 </table>`;
// 			if(response.msg){
// 				$('.box-pencarian').html('<div class="alert alert-danger"><p class="text-center">'+response.msg+'</p></div>');
// 			}else{
// 				$('.box-pencarian').html(html);
// 			}			
//         },
//         error: function(xhr, status, error) {
//             // Tangani error
//             console.error(error);
//         }
//     });
// })

// $('#frm-cari-buku').submit(function(event) {
// 	event.preventDefault();
// 	const formData = $(this).serialize();
// 	const formDataObj = Object.fromEntries(new URLSearchParams(formData));
// 	// $('.box-pilih-buku').html('')
// 	if(formDataObj.keyword){	
// 		$.ajax({
// 			type: 'POST',
// 			url: $(this).attr('action'),
// 			data: formData,
// 			dataType:"JSON",
// 			success: function(response) {
// 				let htmlisi = '';
// 				let i=1;
// 				response.forEach(element => {
// 					htmlisi += `
// 					<tr>
// 						<td class="d-flex align-items-center justify-content-center" style="height: 100px;">${i++}</td>
// 						<td>
// 							<div class="buku" style="display: flex;"><img src=" ${url}assets/dist/img/buku/${element.foto}" class="image-fluid" width="100" height="100" alt="foto buku"></div>
// 						</td>
// 						<td><strong>${element.judul_buku}</strong><p>Penulis : ${element.penulis}</p></td>
// 						<td>${element.penerbit}</td>
// 						<td>${element.kategori}</td>
// 						<td>${element.nama_rak}</td>
// 						<td>${element.sisa_stok}</td>
// 						<td>					
// 							<div class="form-group">					
// 								<label>
// 									<input type="checkbox" class="flat-red" id="idbuku-${element.kd_buku}">
// 									PILIH
// 								</label>					
// 							</div>	
// 						</td>
// 					</tr>`
// 				});				
// 				const htmlbody = `
// 				<table id="example1" class="table table-bordered table-striped">
// 					<thead>
// 						<tr>
// 							<th>#</th>
// 							<th>SAMPUL</th>
// 							<th>JUDUL</th>
// 							<th>PENERBIT</th>
// 							<th>KATEGORI</th>
// 							<th>RAK</th>
// 							<th>SISA STOK</th>
// 							<th>Aksi</th>
// 						</tr>
// 					</thead>
// 					<tbody>
// 						${htmlisi}
// 					</tbody>
// 				</table>`;
// 				$('.box-hasil-pencarian').html(htmlbody);
// 				$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
// 					checkboxClass: 'icheckbox_flat-green',
// 					radioClass   : 'iradio_flat-green'
// 				}).on('ifChecked', function(event){				
// 					const text = $(this).attr('id');
// 					const id = text.split("-")[1];			
// 					fetchData(url + "Buku/getby_buku_id/"+id, "GET", bukuTerpilih); 
// 				}).on('ifUnchecked', function(event){
// 					// Menghapus box yang sesuai ketika checkbox atau radio button tidak lagi dipilih
// 					$('.' + $(this).attr('id')).remove();
// 				});

// 			}
// 		});
// 	}

// });
// function bukuTerpilih(response){
// 	const data = JSON.parse(response)
// 	console.log(data);
// 	console.log(url);
// 	const htmlBoxBukuTerpilih = 
// 	` <div class="col-lg-4 idbuku-${data.kd_buku}">
// 		<div class="box box-solid">
// 			<span class="pull-right" style="padding: 10px;cursor:pointer"><i class="fa fa-close"></i></span>
// 			<div class="box-body">
// 				<div class="d-flex">
// 					<img src="${url+"assets/dist/img/buku/"+data.foto}" width="100"  alt="" style="margin-right:10px; border:2px solid grey;     height: 100px; ">
// 					<div class="d-flex flex-direction-column">
// 					<h5>${data.judul_buku}</h5>
// 					<small  style="font-size:11px">PENULIS : ${data.penulis}</small>
// 					</div>
// 				</div>
// 			</div>
// 		</div>
// 	</div>`;

// 	const htmlboxpilih = `	
// 	<div class="idbuku-${data.kd_buku}" id="${data.kd_buku}">
// 		<div class="col-lg-4 box-terpilih">
// 			<div class="info-box bg-white">
// 				<span class="info-box-icon">
// 					<img src="${url+"assets/dist/img/buku/"+data.foto}" width="100%">
// 				</span>
// 				<div class="info-box-content">
// 					<span class="info-box-text"><small>${data.judul_buku}</small></span>
// 					<span class="info-box-text"><small  style="font-size:11px">PENULIS : ${data.penulis}</small></span>
// 					<div class="progress">
// 						<div class="progress-bar" style="width: 0%"></div>
// 					</div>
// 					<span class="progress-description">Stok Tersisa : ${data.sisa_stok}</span>
// 				</div>				
// 			</div>				
// 		</div>				
// 	</div>`;
// 	$('.box-pilih-buku').append(htmlBoxBukuTerpilih);	
// }


