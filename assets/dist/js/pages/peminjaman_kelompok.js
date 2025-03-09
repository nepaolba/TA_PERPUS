$('#daftarAnggota').DataTable();
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
const url = $(document)[0].location.origin +"/perpus/";
$('input[type="radio"].flat-red.pilih-pj').iCheck({
    radioClass   : 'iradio_flat-green'
}).on('ifChecked', function(event){	
    const selectedValue = $(this).val();
    $('#pj').val(selectedValue);
})


if($('#kelas').val()){
	let alfabe = [];
    let alfabe1 = [];
    const jurusa = `<div class="col-lg-4">
    <div class="form-group">
        <label for="rombel">Jurusan</label>
        <select name="jurusan" id="jurusan" class="form-control input-lg" required>
            <option value="">Pilih Jurusan</option>
            <option value="IPA">IPA</option>
            <option value="IPS">IPS</option>
            <option value="BAHASA">BAHASA</option>
        </select> 
    </div>
</div>`;
    // Loop untuk menghasilkan opsi alfabet
    for (let y = 65; y <= 90; y++) {
        alfabe.push("<option>" + String.fromCharCode(y) + "</option>");
    }
    for (let  z= 1; z <= 10; z++) {        
        alfabe1+=("<option>" + z + "</option>");
    }
    if($('#kelas').val() != 'X'){
        $(".jurusan-box").html(jurusa);
        $(".rombel").html('<option value="">Pilih Rombel</option>'+alfabe1)
    }else{
       $(".rombel").html('<option value="">Pilih Rombel</option>'+ alfabe)
        $(".jurusan-box").html('');
    }
}


$('#kelas').on('change', function(){
    let alfabet = [];
    let alfabet1 = [];
    const jurusan = `<div class="col-lg-4">
    <div class="form-group">
        <label for="rombel">Jurusan</label>
        <select name="jurusan" id="jurusan" class="form-control input-lg" required>
            <option value="">Pilih Jurusan</option>
            <option value="IPA">IPA</option>
            <option value="IPS">IPS</option>
            <option value="BAHASA">BAHASA</option>
        </select> 
    </div>
</div>`;
    // Loop untuk menghasilkan opsi alfabet
    for (let i = 65; i <= 90; i++) {
        alfabet.push("<option>" + String.fromCharCode(i) + "</option>");
    }
    for (let x = 1; x <= 10; x++) {        
        alfabet1+=("<option>" + x + "</option>");
    }
    if($(this).val() != 'X'){
        $(".jurusan-box").html(jurusan);
        $(".rombel").html('<option value="">Pilih Rombel</option>'+alfabet1)
    }else{
       $(".rombel").html('<option value="">Pilih Rombel</option>'+ alfabet)
        $(".jurusan-box").html('');
    }
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
							<a href="${url+"Peminjaman/cekPeminjamanKelompok/"+$('#anggota').data('anggota')+"/"+element.kd_buku+"/"+$('#anggota').data('kelas')}" class="btn btn-sm btn-primary" >PILIH</a>
								
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
				$("#table-cari-buku-individu>tbody").html(htmlBukuAnggotaIndividu); 
				
			}
		});
	}else{
		console.log('silahkan masukan keyword pencarian');
	}
})

// $('#btn-simpan').on('click', function(){
// 	// const today = new Date();
// 	const path = window.location.pathname;
// 	const segments = path.split("/");
// 	// const onWeekLatter = new Date(today.getTime()+ (7*24*60*60*1000));
// 	// const tgl_jatuh_tempo =	onWeekLatter.getFullYear()+"-" +String(onWeekLatter.getMonth() + 1).padStart(2, "0") +"-" +	String(onWeekLatter.getDate()).padStart(2, "0") +" " + onWeekLatter.getHours()+ ":"+ onWeekLatter.getMinutes()+":"+ onWeekLatter.getSeconds();
// 	// const tgl_hari_ini = today.getFullYear()+"-" +String(today.getMonth() + 1).padStart(2, "0") +"-" +String(today.getDate()).padStart(2, "0") +" " + today.getHours()+ ":"+ today.getMinutes()+":"+ today.getSeconds();
// 	const kd_anggota = segments[4];
// 	const kd_buku = segments[5];
// 	window.location.href=url+"Peminjaman/simpanPeminjamanKelompok/"+kd_anggota+"/"+ kd_buku
// 	// $.ajax({
// 	// 	url:url + 'Peminjaman/simpanPeminjamanIndividu/',
// 	// 	type: 'POST',
// 	// 	data:{kd_anggota,kd_buku,tgl_hari_ini,tgl_jatuh_tempo},
// 	// 	success: function(response) {
// 	// 		const a = JSON.parse(response)
// 	// 		if(a =="sukses"){
// 	// 			window.location.href = url+"/Peminjaman"
// 	// 		}
// 	// 		console.log(a)
// 	// 	}
// 	// })

// })
