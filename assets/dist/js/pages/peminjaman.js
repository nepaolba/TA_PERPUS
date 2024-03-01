const url = $(document)[0].location.origin + "/perpustakaan/";
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

$('input[type="radio"].flat-red').iCheck({
	radioClass: "iradio_flat-green",
});
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
	Toast.fire({
		icon: Fclass,
		title: Fnotif,
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
