const url = $(document)[0].location.origin + '/perpustakaan/';
$('input[type="radio"].flat-red').iCheck({
    radioClass: 'iradio_flat-green'
});
typeForm('individu');
$('#input-box').html(htmlInputIndividu);
eventClickJenisPeminjaman('individu');
eventClickJenisPeminjaman('kelompok');
fetchData(url + 'Peminjaman/getAjaxAllKategori', 'GET', optionKategori); //ambil data kategori

$('.select2').select2();
// $('#addPinjam').on('submit', function(event){
//    event.preventDefault();
//    console.log($(this).data('type-form'))
// });
function optionKategori(response) {
    const arrayKategori = JSON.parse(response);
    let option = '';
    arrayKategori.forEach(element => {
        option += '<option value="' + element.kd_kategori + '">' + element.kategori + '</option>';
    });
    $('#kd_kategori').html('<option value="">Pilih Kategori</option>' + option);
}
function eventClickJenisPeminjaman(type) {
    $('label[for=' + type + '],label[for=' + type + '] .iCheck-helper').on('click', function () {
        typeForm(type);
        type == 'kelompok' ? $('#input-box').html(htmlInputKelompok) : '';
        type == 'individu' ? $('#input-box').html(htmlInputIndividu) : '';
        fetchData(url + 'Peminjaman/getAjaxAllKategori', 'GET', optionKategori); //ambil data kategori
        $('.select2').select2();
    });
}
function fetchData(url, method, successCallback) {
    $.ajax({
        url: url,
        method: method,
        success: successCallback
    });
}
function typeForm(type) {
    $("#addPinjam").attr('data-type-form', type).data('type-form', type);
}
function htmlInputIndividu() {
    return `
      <div class="form-group">
         <label for="kd_kategori">Kategori</label>
         <select id="kd_kategori" class="form-control select2" style="width: 100%;">
            <option value="">Pilih Kategori</option>
         </select>
      </div>
      <div class="form-group">
         <label for="kd_buku">Buku</label>
         <select name="kd_buku" id="kd_buku" class="form-control select2" style="width: 100%;">
            <option value="">Pilih Buku</option>
         </select>
      </div>
      <div class="form-group">
         <label for="kd_anggota">Nama Anggota</label>
         <select name="nis_nip" id="kd_anggota" class="form-control select2" style="width: 100%;">
            <option value="">Pilih Anggota</option>
         </select>
      </div>
      <div class="form-group">
         <label for="datepicker">Tanggal Pengembalian</label>
         <input type="text" name="tgl_kembali" class="form-control" id="datepicker" autocomplete="off">
      </div>`;
}
function htmlInputKelompok() {
    return `<div class="form-group"><label for="kd_kategori">Kategori</label><select id="kd_kategori" class="form-control select2" style="width: 100%;">   <option value="">Pilih Kategori</option></select></div>
      <div class="form-group"><label for="kd_buku">Buku</label><select name="kd_buku" id="kd_buku" class="form-control select2" style="width: 100%;">   <option value="">Pilih Buku</option></select></div>
      <div class="form-group"><label for="kd_anggota">Penangung jawab</label><select name="nis_nip" id="kd_anggota" class="form-control select2" style="width: 100%;">   <option value="">Pilih Anggota</option></select></div> 
      <div class="form-group"><label for="kelas">Kelas</label><input type="text" name="kelas" id="kelas" class="form-control"  placeholder="Masukan Kelas"></div>
      <div class="form-group"><label for="jumlah_pinjam">Jumlah Peminjaman</label><input type="text" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control" placeholder="Masukan jumlah peminjaman"></div>
      <div class="bootstrap-timepicker"><div class="form-group">   <label for="waktu">Jam Pengembalian</label>   <input type="text" name="waktu"  id="waktu" class="form-control timepicker" autocomplete="off"></div></div> `;
}
