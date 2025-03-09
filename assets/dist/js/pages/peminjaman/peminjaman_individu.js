const url = $(document)[0].location.origin +"/perpus/";
$(".select2").select2();
$('#daftarAnggota').DataTable({
    language: {
        search: ""
    },
    pageLength: 25
});
$('.dataTables_filter input')
.attr('placeholder', 'Cari Anggota ...')
    .css({
        'width': '790px',
        'border': '2px solid rgba(0, 172, 214, 0.35)',
        'border-radius': '10px'
    })
    .removeClass('input-sm')
    .addClass('input-lg');
    $('input[type="radio"].flat-red.pilih-pj').iCheck({
        radioClass   : 'iradio_flat-green',
    }).on('ifChecked', function(event){	
        window.location.href = "Peminjaman_Individu/cek_jumlah_peminjaman/"+$(this).attr('id');
        // inggat ganti ke post
    })
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



    $(document).ready(function() {
        $('#kategori-buku').on('change', function() {
            const kategoriId = $(this).val();
            
            // Cek apakah kategori telah dipilih
            if(kategoriId) {
                $.ajax({
                    url: url+'Peminjaman_Individu/get_buku_by_kategori', // Ganti dengan URL endpoint di server untuk mengambil buku
                    method: 'POST',
                    data: { kategori_id: kategoriId },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        // Kosongkan dulu daftar buku yang ada
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
    });
    