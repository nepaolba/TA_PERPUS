const url = $(document)[0].location.origin +"/perpus/";
$(".select2").select2();

$(document).ready(function() {
    
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
            title: Fclass.toUpperCase(),
            text: Fnotif,
            icon: Fclass
          });
    }


    $('#kategori-buku').on('change', function() {
        const kategoriId = $(this).val();        
        // Cek apakah kategori telah dipilih
        if(kategoriId) {
            $.ajax({
                url: url+'Buku/get_buku_by_kategori', // Ganti dengan URL endpoint di server untuk mengambil buku
                method: 'POST',
                data: { kategori_id: kategoriId },
                dataType: 'json',
                success: function(response) {
                    $('#judul-buku').empty();                    
                    // Tambahkan opsi default
                    $('#judul-buku').append('<option value="">PILIH JUDUL BUKU</option>');                    
                    // Iterasi hasil response dan tambahkan ke dropdown buku
                    $.each(response.dataBuku, function(index, buku) {
                        $('#judul-buku').append('<option value="' + buku.kd_buku+ '">' + buku.judul_buku + '</option>');
                        console.log(buku)
                    });
                },
                error: function() {
                    alert('Gagal mengambil data buku.');
                }
            });
        } else {
            // Jika kategori tidak dipilih, kosongkan daftar buku
            $('#judul-buku').empty();
            $('#judul-buku').append('<option value="">PILIH JUDUL BUKU</option>');
        }
    });



    $('#kategori-buku-kelas').on('change', function() {
        const kategoriId = $(this).val();        
        // Cek apakah kategori telah dipilih
        if(kategoriId) {
            $.ajax({
                url: url+'Buku/get_buku_by_kategori', // Ganti dengan URL endpoint di server untuk mengambil buku
                method: 'POST',
                data: { kategori_id: kategoriId },
                dataType: 'json',
                success: function(response) {
                    $('#judul-buku-kelas').empty();                    
                    // Tambahkan opsi default
                    $('#judul-buku-kelas').append('<option value="">PILIH JUDUL BUKU</option>');                    
                    // Iterasi hasil response dan tambahkan ke dropdown buku
                    $.each(response.dataBuku, function(index, buku) {
                        $('#judul-buku-kelas').append('<option value="' + buku.kd_buku+ '">' + buku.judul_buku + '</option>');
                        console.log(buku)
                    });
                },
                error: function() {
                    alert('Gagal mengambil data buku.');
                }
            });
        } else {
            // Jika kategori tidak dipilih, kosongkan daftar buku
            $('#judul-buku-kelas').empty();
            $('#judul-buku-kelas').append('<option value="">PILIH JUDUL BUKU</option>');
        }
    });





    // id="pilih-anggota"
    $('#pilih-anggota').on('change', function() {
        const anggota = $(this).val(); 
        if(anggota) {
            $.ajax({
                url: url+'Anggota/get_status_anggota', // Ganti dengan URL endpoint di server untuk mengambil buku
                method: 'POST',
                data: { kd_anggota: anggota },
                dataType: 'json',
                success: function(response) {
                    if(response.status_anggota == '0'){
                        $('#jumlahPinjam').html(''); 
                        $('#jumlahPinjam').append(`
                                 <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Jumlah Pinjam</label>    
                            <div class="col-sm-2">
                                <input type="text" class="form-control" autofocus="" name="jumlahPinjam" id="jumlahPinjam" placeholder="Jumlah Buku">
                            </div>
                        </div>`);
                    }else{
                        $('#jumlahPinjam').html(''); 
                    }

                },
                error: function() {
                    alert('Gagal mengambil data anggota');
                }
            }); 
        } else {
            // Jika kategori tidak dipilih, kosongkan daftar buku
            $('#jumlahPinjam').html(''); 
        }
    })




    
if($('#kelas').val()){
	let alfabe = [];
    let alfabe1 = [];
    const jurusa = `
        <label for="rombel">Jurusan</label>
        <select name="jurusan" id="jurusan" class="form-control" required>
            <option value="">Pilih Jurusan</option>
            <option value="IPA">IPA</option>
            <option value="IPS">IPS</option>
            <option value="BAHASA">BAHASA</option>
        </select> 
`;
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
        const jurusan = `   
                    <select name="jurusan" id="jurusan" class="form-control" required>
                        <option value="">Pilih Jurusan</option>
                        <option value="IPA">IPA</option>
                        <option value="IPS">IPS</option>
                        <option value="BAHASA">BAHASA</option>
                    </select> 
           `;
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


    


   //$('a[href="#settings"]').tab('show'); // Memilih tab 'Kelas' secara otomatis



})
