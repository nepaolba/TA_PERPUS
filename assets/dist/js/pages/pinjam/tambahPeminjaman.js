// const url = $(document)[0].location.origin +"/perpus/";
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


    function changeKategoriBuku(kategoriId) {
        if(kategoriId) {
            $.ajax({
                url: url+'get_buku_by_kategori',
                method: 'POST',
                data: { kategori_id: kategoriId },
                dataType: 'json',
                success: function(response) {
                    $('#judul-buku').empty();       
                    $('#judul-buku').append('<option value="">PILIH JUDUL BUKU</option>'); 
                    $.each(response.dataBuku, function(index, buku) {
                        $('#judul-buku').append('<option value="' + buku.kd_buku+ '">' + buku.judul_buku + '</option>');
                        
                    });
                },
                error: function() {
                    alert('Gagal mengambil data buku.');
                }
            });
        } else {
            $('#judul-buku').empty();
            $('#judul-buku').append('<option value="">PILIH JUDUL BUKU</option>');
        }
    }

    function loadKategoriBuku() {
        $.ajax({
            url: url + 'get_kategori',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#kategori-buku').empty();
                // $('#kategori-buku-kelas').empty();
                $('#kategori-buku').append('<option value="">PILIH KATEGORI BUKU</option>');
                // $('#kategori-buku-kelas').append('<option value="">PILIH KATEGORI BUKU</option>');
                $.each(response, function(index, kategori) {
                    $('#kategori-buku').append('<option value="' + kategori.kd_kategori + '">' + kategori.kategori + '</option>');
                });
            },
            error: function() {
                alert('Gagal mengambil data kategori buku.');
            }
        });
    }
    
    function cekStatusPeminjamanBuku(kd_buku, kd_anggota) {
        $.ajax({
            url: url + 'ajax_validasi_peminjaman',
            method: 'POST',
            data: { kd_buku, kd_anggota },
            dataType: 'json',
            success: function(response) {
                console.log(response);
            },
            error: function() {
                alert('Gagal mengambil data buku.');
            }
        });
    }
    
    // Panggil fungsi untuk memuat kategori buku saat halaman dimuat
    loadKategoriBuku();
    
    // Event listener untuk perubahan kategori buku
    $('#kategori-buku').on('change', function() {
        const kategoriId = $(this).val();
        changeKategoriBuku(kategoriId);
    });
    
    // Event listener untuk memeriksa status peminjaman buku
    $('#judul-buku').on('change', function() {
        const kd_buku = $(this).val();
        const anggota = $('#pilih-anggota').val();
        cekStatusPeminjamanBuku(kd_buku, anggota);
    });



    $('#kategori-buku-kelas').on('change', function() {
        const kategoriId = $(this).val();   
        if(kategoriId) {
            $.ajax({
                url: url+'get_buku_by_kategori',
                method: 'POST',
                data: { kategori_id: kategoriId },
                dataType: 'json',
                success: function(response) {
                    $('#judul-buku-kelas').empty();
                    $('#judul-buku-kelas').append('<option value="">PILIH JUDUL BUKU</option>');  
                    $.each(response.dataBuku, function(index, buku) {
                        if(buku.jumlah_buku > 0){
                            $('#judul-buku-kelas').append('<option value="' + buku.kd_buku+ '">' + buku.judul_buku + '</option>');                            
                        }                  
                    });
                },
                error: function() {
                    alert('Gagal mengambil data buku.');
                }
            });
        } else {
            $('#judul-buku-kelas').empty();
            $('#judul-buku-kelas').append('<option value="">PILIH JUDUL BUKU</option>');
        }
    });






    $('#pilih-anggota').on('change', function() {
        const anggota = $(this).val(); 
        loadKategoriBuku();
        changeKategoriBuku(kategoriId="");
        if(anggota) {
            $.ajax({
                url: url+'get_status_anggota', 
                method: 'POST',
                data: { kd_anggota: anggota },
                dataType: 'json',
                success: function(response) {
                    if(response.jenis_anggota == '0'){
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
            </select>  `;
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
//    $('a[href="#settings"]').tab('show');
})
function showTime() {
    var a_p = "";
    var today = new Date();
    var curr_hour = today.getHours();
    var curr_minute = today.getMinutes();
    var curr_second = today.getSeconds();
    if (curr_hour < 12) {
        a_p = "AM";
    } else {
        a_p = "PM";
    }
    if (curr_hour == 0) {
        curr_hour = 12;
    }
    if (curr_hour > 12) {
        curr_hour = curr_hour - 12;
    }
    curr_hour = checkTime(curr_hour);
    curr_minute = checkTime(curr_minute);
    curr_second = checkTime(curr_second);
    document.getElementById('jam').value = curr_hour + ":" + curr_minute + ":" + curr_second;
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
setInterval(showTime, 500);