$(document).ready(()=>{	
let datapin ="";
	function selectKosong(){
		$("#input-anggota").fadeIn("fast").
			html(`
			<select name="nis_nip" id="kd_anggota" class="form-control select2" style="width: 100%;">
					<option value="">Pilih Anggota</option>
			</select>`
		);
	}

	function detailPinjam(response){
		let detailpeminjaman ="";
		detailpeminjaman = JSON.parse(response);		
		const htmlIndividu =`
			<h4 class="box-title">DETAIL PEMINJAMAN</h4>
			<table class="table">	
				<tr><td>Nama Anggota</td><th class="text-center" width="20"> : </th><td>${detailpeminjaman.nama_anggota}</td></tr>	
				<tr><td>Judul Buku</td><th class="text-center" width="20"> : </th><td>${detailpeminjaman.judul_buku}</td></tr>
				<tr><td>Tanggal Pinjam</td><th class="text-center" width="20"> : </th><td>${ubahFormatTanggal(detailpeminjaman.tgl_pinjam, 'tanggal')}</td></tr>
				<tr><td>Tanggal Pengembalian </td><th class="text-center" width="20"> : </th><td><span class="label label-warning">${ubahFormatTanggal(detailpeminjaman.tgl_kembali, "tanggal")}</span> </td></tr>	
				<tr><td>Jumlah Peminjaman </td><th class="text-center" width="20"> : </th><td>${detailpeminjaman.jumlah_pinjam} </td></tr>	
			</table>`;
		const htmlkelompok =`
			<h4 class="box-title">DETAIL PEMINJAMAN</h4>
			<table class="table">	
				<tr><td>Nama Penangung Jawab</td><th class="text-center" width="20"> : </th><td>${detailpeminjaman.nama_anggota}</td></tr>	
				<tr><td>Judul Buku</td><th class="text-center" width="20"> : </th><td>${detailpeminjaman.judul_buku}</td></tr>
				<tr><td>Tanggal Pinjam</td><th class="text-center" width="20"> : </th><td>${ubahFormatTanggal(detailpeminjaman.tgl_pinjam, 'jam')}</td></tr>
				<tr><td>Waktu Pengembalian </td><th class="text-center" width="20"> : </th><td>${ubahFormatTanggal(detailpeminjaman.tgl_kembali, "jam")} </td></tr>	
				<tr><td>Jumlah Peminjaman </td><th class="text-center" width="20"> : </th><td>${detailpeminjaman.jumlah_pinjam} </td></tr>	
			</table>`;

			if(detailpeminjaman.jenis_pinjam == "0"){
				$('#detail-pinjam').fadeIn('fast').html(htmlIndividu);
			}else{
				$('#detail-pinjam').fadeIn('fast').html(htmlkelompok);
			}
		detailBuku(response);
		detailAnggota(response);
		datapin = detailpeminjaman
		// console.log(datapin);
	}

	function createBox(title, content) {
		return `
			<div class="box box-solid new-shadow">
				<div class="box-header"><h4 class="box-title">${title}</h4></div>
				<div class="box-body"><table class="table">${content}</table></div>
			</div>
		`;
	}

	function detailBuku(response){
		const detailBuku = JSON.parse(response)
		$(".detail-book").fadeIn('fast')
			.html(createBox("Informasi Buku",`			       
				<tr><td><img src="../assets/dist/img/buku/${detailBuku.foto}" width="150" alt="buku" style="border:5px solid #80808042;border-radius:5px;padding:2px"><br><br></td></tr>
				<tr><td>Judul Buku</td><th class="text-center" width="20"> : </th><td>${detailBuku.judul_buku}</td></tr>
				<tr><td>Pengarang</td><th class="text-center" width="20"> : </th><td>${detailBuku.penulis}</td></tr>
				<tr><td>Penerbit</td><th class="text-center" width="20"> : </th><td>${detailBuku.penerbit}</td></tr>
				<tr><td>Tahun Terbit</td><th class="text-center" width="20"> : </th><td>${detailBuku.tahun_terbit}</td></tr>
				<tr><td>ISBN</td><th class="text-center" width="20"> : </th><td>${detailBuku.isbn}</td></tr>
				<tr><td>Jumlah Buku</td><th class="text-center" width="20"> : </th><td>${detailBuku.jumlah_buku}</td></tr>
				<tr><td>Kategori Buku</td><th class="text-center" width="20"> : </th><td>${detailBuku.kategori}</td></tr>
				<tr><td>Rak Buku</td><th class="text-center" width="20"> : </th><td>${detailBuku.nama_rak}</td></tr>
				<tr><td>Dipinjam</td><th class="text-center" width="20"> : </th><td>${detailBuku.jumlah_dipinjam}</td></tr>
				<tr><td>Tersedia</td><th class="text-center" width="20"> : </th><td><small class="label label-info"> ${detailBuku.sisa_stok} Stok Buku</small></td></tr>
			`)
		);
	}

	function detailAnggota(response) {
		// console.log(response)
		const detailAnggota = JSON.parse(response);		
		$(".detail-anggota").fadeIn().
			html(createBox("Detail Anggota",`			
				<tr><td>Nama Lengkap</td><th class="text-center" width="20"> : </th><td>${detailAnggota.nama_anggota}</td></tr>
				<tr><td>NIP/NIS</td><th class="text-center" width="20"> : </th><td>${detailAnggota.kd_anggota}</td></tr>
				<tr><td>Jenis Kelamin</td><th class="text-center" width="20"> : </th><td>${detailAnggota.jk == "0" ? "Laki-laki" : "Perempuan"}</td></tr>
				<tr><td>Alamat</td><th class="text-center" width="20"> : </th><td>${detailAnggota.alamat}</td></tr>
				<tr><td>Nomor HP</td><th class="text-center" width="20"> : </th><td>${detailAnggota.nohp}</td></tr>
				<tr><td>Status Anggota</td><th class="text-center" width="20"> : </th><td>${detailAnggota.status == "0" ? "Guru" : "Siswa"}</td></tr>
			`)
		);
	}

	function ubahFormatTanggal(tgl, type){
		const date =  new Date(tgl)
		return type === "tanggal" ? String(date.getDay()).padStart(2,"0")+"/"+ String(date.getMonth()).padStart(2,"0")+"/"+ date.getFullYear(): date.getHours() +":"+ date.getMinutes();
	}

	function getAjax(url, successCallback){
		$.ajax({
			url: url, 
			method: "POST", 
			success: successCallback
		});
	}

	function dataAnggotaPeminjam(responseSuccess){
		
		const anggota =  JSON.parse(responseSuccess)
		let option="";
		anggota.forEach((value) => {
			option += `<option value="${value.kd_anggota}"> ${value.kd_anggota + ' = ' + value.nama_anggota }</option>`;
		})
		$('#kd_anggota').html(`<option value="">Pilih Anggota</option>`+option)
		
	}
	
	function updateDataTypeForm(type) {
		$("#addPengembalian").attr("data-type-form", type).data("type-form", type);
	}

	function showAlert() {
		Swal.fire({
			title: 'Pemberitahuan',
			text: 'Silahkan Pilih Anggota terlebih dahulu',
			icon: 'warning', // tipe ikon: 'success', 'error', 'warning', 'info', 'question'
			confirmButtonText: 'Ok',
			customClass: {
				popup:"custom-swal2-popup"
			}
		});
	}


	// function dataFix(response) {
	// 	return response
	// }


	// function submitPengembalian(response="" ){
		$("#addPengembalian").on("submit", function(e){
			e.preventDefault();
			if(datapin){				
				$.ajax({
					url:"submitPengembalian",
					method:"POST",
					data : datapin,
					success:function(res){
						window.location.href = "../Pengembalian"
						// console.log(res)
					}
				})
			}else{

				showAlert()
			}
		})


	$(document).on("change", "#kd_anggota",  function(){
		const kd_anggota = $(this).val();
		const jenis_pinjam = $(".iradio_flat-blue.checked .jenis-pinjam").val();
		jenis_pinjam === "individu"?
			getAjax('detailPeminjamanAnggota/'+kd_anggota+"/0", detailPinjam):
			getAjax('detailPeminjamanAnggota/'+kd_anggota+"/1", detailPinjam);
			
		
	})
	
	$(".jenis-pinjam").on("ifChecked",function(){
		$('#detail-pinjam, .detail-anggota, .detail-book, #input-anggota').fadeOut('fast');
		selectKosong()
		$(".select2").select2();
		const val = $(this).val();
		val == "individu" ? getAjax('ambilSemuaDataAnggota/0', dataAnggotaPeminjam):getAjax('ambilSemuaDataAnggota/1', dataAnggotaPeminjam);
	})



	getAjax('ambilSemuaDataAnggota/0', dataAnggotaPeminjam)	
	selectKosong()
	$(".select2").select2();
	$('input[type="radio"].flat-red').iCheck({
		radioClass: "iradio_flat-blue",
	});	
	$("#example1").dataTable({
		ordering: false,
	})

	
// submitPengembalian();



})




