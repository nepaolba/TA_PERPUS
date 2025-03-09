<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>AdminLTE 2 | Top Navigation</title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/Ionicons/css/ionicons.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/AdminLTE.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/skins/_all-skins.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/custom.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-black layout-top-nav ">
   <div class="wrapper">
      <header class="main-header ">
         <nav class="navbar navbar-fixed-top bg-transparent">
            <div class="container poppins-semibold">
               <div class="navbar-header">
                  <a href="<?= base_url('assets/') ?>index2.html" class="navbar-brand text-orange"><b class="text-blue">PERPUS</b>TAKAAN</a>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                     <i class="fa fa-bars"></i>
                  </button>
               </div>
               <div class="collapse navbar-collapse " id="navbar-collapse">
                  <ul class="nav navbar-nav navbar-right ">
                     <li class="active"><a href="#">Beranda <span class="sr-only">(current)</span></a></li>
                     <li><a href="../layout/koleksi.html">Koleksi</a></li>
                     <!-- <li><a href="#">Belajar</a></li> -->
                     <li><a href="#">Rak Buku</a></li>
                     <li><a href="#">Bantuan</a></li>
                     <li><a href="#">Tentang</a></li>
                     <li><a href="#">Login</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <!-- Full Width Column -->
      <section class="homePage">
         <div class="container">
            <div class="row">
               <div class="img-homepage flex-wrap active ">
                  <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 ">
                     <div class="d-flex d-flex align-items-center">
                        <img src="<?= base_url('assets/') ?>dist/img/slide/<?= $slide[0]->img ?>" width="100%" alt="slider">
                     </div>
                  </div>
                  <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 d-flex align-items-center">
                     <div class="">
                        <h2 class="keterangan poppins-black">
                           <span class="text-orange">SISTEM INFORMASI</span>
                           <span class="text-blue">PERPUSTAKAAN SMAN 5 KUPANG?</span>
                        </h2>
                        <p class="poppins-light">
                           Apapun kebutuhan pendidikanmu, Perpustakaan siap nemenin kamu! Temukan solusi terbaik untuk dilemamu
                           lewat perpustakaan SMN 5 KUPANG!
                        </p>
                        <a href="#" class="btn btn-lg btn-home">GABUNG SEKARANG</a>
                     </div>
                  </div>
               </div>
               <div class="img-homepage  flex-wrap ">
                  <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 ">
                     <div class="d-flex d-flex align-items-center">
                        <img src="<?= base_url('assets/') ?>dist/img/slide/<?= $slide[1]->img ?>" width="100%" alt="slider">
                     </div>
                  </div>
                  <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 d-flex align-items-center">
                     <div class="">
                        <h2 class="keterangan poppins-black">
                           <span class="text-orange">Gabung Bersama Kami </span>
                           <span class="text-blue">di Perpustakaan SMAN 5 KUPANG</span>
                        </h2>
                        <p class="poppins-light">
                           Apapun kebutuhan pendidikanmu, Aku Pintar siap nemenin kamu! Temukan solusi terbaik untuk dilemamu
                           lewat
                           Konseling Pintar dalam aplikasi pendidikan terlengkap di Indonesia!
                        </p>
                        <a href="#" class="btn btn-lg btn-home">GABUNG SEKARANG</a>
                     </div>
                  </div>
               </div>
               <div class="img-homepage  flex-wrap">
                  <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                     <div class="d-flex d-flex align-items-center">
                        <img src="<?= base_url('assets/') ?>dist/img/slide/<?= $slide[2]->img ?>" width="100%" alt="slider">
                     </div>
                  </div>
                  <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 d-flex align-items-center">
                     <div class="">
                        <h2 class="keterangan poppins-black">
                           <span class="text-orange">Gabung Bersama Kami </span>
                           <span class="text-blue">di Perpustakaan SMAN 5 KUPANG</span>
                        </h2>
                        <p class="poppins-light">
                           Apapun kebutuhan pendidikanmu, Aku Pintar siap nemenin kamu! Temukan solusi terbaik untuk dilemamu
                           lewat
                           Konseling Pintar dalam aplikasi pendidikan terlengkap di Indonesia!
                        </p>
                        <a href="#" class="btn btn-lg btn-home">GABUNG SEKARANG</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 dots ">
                  <div class="d-flex justify-content-center">
                     <span class="dot"></span>
                     <span class="dot"></span>
                     <span class="dot"></span>
                  </div>
               </div>
            </div>
         </div>
         <section class="bener">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <h2 class="poppins-bold">Rahi mimpi-mimpi besar mu dengan membaca.
                     <br>
                     <span class="text-blue">#Perpustakaan</span>
                     <span class="text-orange"> SMAN 5 KUPANG</span>
                  </h2>
                  <a href="#" class="btn btn-lg btn-home">GABUNG SEKARANG</a>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12 text-center pt-30">
                  <h2 class="info poppins-bold">Buku Terbaru</h2>
               </div>
               <div class="col-lg-12 pt-30 info-img">
                  <div class="row">
                     <div class="d-flex justify-content-center">
                        <div class="col-lg-7 ">
                           <div class="box box-solid">
                              <div class="box-body p-0">
                                 <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators" style="bottom: -52px;">
                                       <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                       <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                       <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                       <div class="item active ">
                                          <div class="col-lg-5 p-0">
                                             <img src="<?= base_url('assets/') ?>dist/img/img-info1.png" width="100%" alt="First slide">
                                          </div>
                                          <div class="col-lg-7">
                                             <div class="carousel-caption">
                                                <p class="text-blue">Webinar</p>
                                                <h2>KKP "Mengenal Retorika: Seni Bicara dan Bertutur Kata"</h2>
                                                <p class="text-gray">Biar gak monoton, yuk, kemas gaya bicaramu lewat retorika yang
                                                   keren</p>
                                                <a href="#" class="btn btn-lg btn-home-outline">BACA SEKARANG</a>
                                             </div>

                                          </div>
                                       </div>
                                       <div class="item">
                                          <div class="col-lg-5  p-0">
                                             <img src="<?= base_url('assets/') ?>dist/img/img-info2.png" width="100%" alt="Second slide">
                                          </div>
                                          <div class="col-lg-7">
                                             <div class="carousel-caption" style="max-height: 100px;">
                                                <p class="text-blue">Paket Tes Psikologi 3P Mahir</p>
                                                <h2>Tes Psikologi 3P Mahir</h2>
                                                <p class="text-gray">Dengan Tes Psikologi 3P Mahir di Aku Pintar, dapatkan laporan tes
                                                   lengkap beserta tes IQ. Buruan ikuti tes agar kamu tau potensimu dan siap melangkah ke
                                                   masa depan pintar! Pakai voucher "PSIMAHIR" untuk mendapatkan harga Rp. 40.000</p>
                                                <a href="#" class="btn btn-lg btn-home-outline">BACA SEKARANG</a>
                                             </div>
                                          </div>

                                       </div>
                                       <div class="item">
                                          <div class="col-lg-5  p-0">
                                             <img src="<?= base_url('assets/') ?>dist/img/img-info3.png" width="100%" alt="Third slide">
                                          </div>
                                          <div class="col-lg-7">
                                             <div class="carousel-caption" style="max-height: 100px;">
                                                <p class="text-blue">Paket Tes Psikologi 3P Mahir</p>
                                                <h2>Tes Psikologi 3P Mahir</h2>
                                                <p class="text-gray">Dengan Tes Psikologi 3P Mahir di Aku Pintar, dapatkan laporan tes
                                                   lengkap beserta tes IQ. Buruan ikuti tes agar kamu tau potensimu dan siap melangkah ke
                                                   masa depan pintar! Pakai voucher "PSIMAHIR" untuk mendapatkan harga Rp. 40.000</p>
                                                <a href="#" class="btn btn-lg btn-home-outline">BACA SEKARANG</a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <a class="left carousel-control d-flex justify-content-center" href="#carousel-example-generic" data-slide="prev">
                                       <img src="<?= base_url('assets/') ?>dist/img/left1.svg" width="70" alt="">
                                    </a>
                                    <a class="right carousel-control d-flex justify-content-center" href="#carousel-example-generic" data-slide="next">
                                       <img src="<?= base_url('assets/') ?>dist/img/right.svg" width="70" alt="">
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row bener2">
                        <div class="col-lg-12">
                           <h3 class="poppins-bold">Buku-buku yang <span class="text-blue">sering dibaca</span> di antara
                              <br>
                              <span class="text-blue">koleksi kami</span>
                           </h3>
                           <div class="row d-flex justify-content-center ">
                              <div class="col-lg-3 mt-20" style="width:250px">
                                 <div class="box box-solid box-shadow">
                                    <div class="box-body d-flex justify-content-center" style="min-height: 235px">
                                       <div class="contents d-flex align-items-center flex-colum justify-content-center">
                                          <img src="<?= base_url('assets/') ?>dist/img/ico-tes.webp" width="70" height="70" alt="">
                                          <h4>Tes Kepribadian</h4>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 mt-20" style="width:250px">
                                 <div class="box box-solid">
                                    <div class="box-body d-flex justify-content-center " style="min-height: 235px">
                                       <div class="contents d-flex align-items-center flex-colum justify-content-center">
                                          <img src="<?= base_url('assets/') ?>dist/img/ico-tes2.webp" width="70" height="70" alt="">
                                          <h4>Tes Penjurusan</h4>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 mt-20" style="width:250px">
                                 <div class="box box-solid">
                                    <div class="box-body d-flex justify-content-center" style="min-height: 235px">
                                       <div class="contents d-flex align-items-center flex-colum justify-content-center">
                                          <img src="<?= base_url('assets/') ?>dist/img/ico-tes3.png" width="70" height="70" alt="">
                                          <h4>Tes Kemampuan</h4>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 mt-20" style="width:250px">
                                 <div class="box box-solid">
                                    <div class="box-body d-flex justify-content-center" style="min-height: 235px">
                                       <div class="contents d-flex align-items-center flex-colum justify-content-center">
                                          <img src="<?= base_url('assets/') ?>dist/img/tes.webp" width="70" height="70" alt="">
                                          <h4>Tes Gaya Belajar</h4>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </section>
         <section class="features">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <h2 class="poppins-bold">Visi & Misi Perpustakaan <span class="text-blue">SMA NEGERI 5 KUPANG</span></h2>
                  </div>
                  <div class="col-lg-6 pt-30">
                     <div class="box box-solid bg-blue" style="box-shadow: 7px 7px 1px #9ecee7;">
                        <div class="box-body" style="background: url('../../../assets/dist/img/featur3.png');  background-size: contain;
                  background-repeat: no-repeat;">
                           <div class="col-lg-8 pull-right">
                              <h2 class="poppins-extrabold pt-30" style="font-size: 17px; color:#fff; letter-spacing: .5px; line-height: 25px;">VISI</h2>
                              <p class="pt-30 pb-30">
                                 Bicarakan kegaulanmu dalam memilih jurusan, cara belajar, ataupun masalah akademis lainnya bersama
                                 konselor aku pintar
                              </p>
                              <!-- <a href="">Coba Tes Psikologi</a> -->
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 pt-30">
                     <div class="box box-solid" style="background-color:#e0f4fe; box-shadow: 7px 7px 1px #9ecee7;">
                        <div class="box-body" style="background: url('<?= base_url('assets/') ?>dist/img/featur4.svg'); background-size: contain;
                background-repeat: no-repeat;">
                           <div class="col-lg-8 pull-right">
                              <h2 class="poppins-extrabold pt-30" style="font-size: 17px; color:#424a4c; letter-spacing: .5px; line-height: 25px;">MISI
                              </h2>
                              <p class="pt-30 pb-30">
                                 Aku pintar memberikan kemudahan bagi guru sekolah dan lembaga siswa untuk mengetahui potensi,
                                 kepribadian, dan minat siswa secara
                              </p>
                              <!-- <a href="">Coba Tes Psikologi</a> -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <style>
                  .fs-12 {
                     font-size: 12px;
                  }

                  .fs-10 {
                     font-size: 10px;
                  }

                  .pt-0 {
                     padding-top: 0;
                  }
               </style>
               <div class="row pt-60 p-relative bg-kampus">
                  <div class="col-lg-6">
                     <h2 class="poppins-bold mb-20" style="line-height: 48px;">Sudah siap daftar ke sekolah ataupun kampus dan
                        jurusan impianmu?</h2>
                     <p class="mb-20" style="font-size: 20px; line-height: 30px; font-weight: 400; ">
                        Sobat Pintar bisa mendaftarkan diri ke kampus impian Sobat melalui Aku Pintar, loh! Cari tahu juga
                        informasi lengkap mengenai kampus dan jurusan idamanmu di Kampus Pintar. Bagi Sobat Pintar di bangku
                        SMP, bisa manfaatkan Sekolah Pintar untuk cari info sekolah incaranmu juga!
                     </p>
                  </div>

                  <div class="col-lg-6 pt-30">
                     <div class="col-lg-6">
                        <div class="box box-solid">
                           <div class="box-body d-flex align-items-center pt-0">
                              <img src="<?= base_url('assets/') ?>dist/img/daftar_kampus.png" alt="" width="20%" height="20%">
                              <div class="flex " style="padding-left: 10px;">
                                 <h2 class="poppins-bold fs-12">Pendaftaran Kampus</h2>
                                 <p class="fs-10 poppins-regula">Daftar ke kampus impianmu lebih mudah, praktis dan anti ribet</p>
                                 <a href="" class="poppins-bold fs-10">Coba Sekarang</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="box box-solid">
                           <div class="box-body d-flex align-items-center pt-0">
                              <img src="<?= base_url('assets/') ?>dist/img/cari_jurusan.png" alt="" width="20%" height="20%">
                              <div class="flex " style="padding-left: 10px;">
                                 <h2 class="poppins-bold fs-12">Pendaftaran Kampus</h2>
                                 <p class="fs-10 poppins-regula">Daftar ke kampus impianmu lebih mudah, praktis dan anti ribet</p>
                                 <a href="" class="poppins-bold fs-10">Coba Sekarang</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="box box-solid">
                           <div class="box-body d-flex align-items-center pt-0">
                              <img src="<?= base_url('assets/') ?>dist/img/cari_kampus.png" alt="" width="20%" height="20%">
                              <div class="flex " style="padding-left: 10px;">
                                 <h2 class="poppins-bold fs-12">Pendaftaran Kampus</h2>
                                 <p class="fs-10 poppins-regula">Daftar ke kampus impianmu lebih mudah, praktis dan anti ribet</p>
                                 <a href="" class="poppins-bold fs-10">Coba Sekarang</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="box box-solid">
                           <div class="box-body d-flex align-items-center pt-0">
                              <img src="<?= base_url('assets/') ?>dist/img/cari_sekolah.png" alt="" width="20%" height="20%">
                              <div class="flex " style="padding-left: 10px;">
                                 <h2 class="poppins-bold fs-12">Pendaftaran Kampus</h2>
                                 <p class="fs-10 poppins-regula">Daftar ke kampus impianmu lebih mudah, praktis dan anti ribet</p>
                                 <a href="" class="poppins-bold fs-10">Coba Sekarang</a>
                              </div>
                           </div>
                        </div>
                     </div>


                  </div>
               </div>
            </div>
         </section>
      </section>




      <section class="list-footer px-20 text-center">
         <i class="fa fa-quote-left quote text-blue"></i>
         <h2 class="text-blue poppins-medium" style="font-size: 26px; line-height: 35px; ">Bersama <span class="text-orange">PERPUSTAKAAN</span> temukan Buku
            yang tepat <br>
            sesuai <span class="text-orange">minat dan bakatmu</span> </h2>
      </section>





      <section class="bener-footer poppins-regular">
         <div class="container">
            <div class="col-lg-3 pt-30">
               <img src="<?= base_url('assets/') ?>dist/img/logo.svg" width="150" height="30" class="mb-20" alt="logo">
               <p style="line-height: 24px;">Sekolah Menengah Atas Muhammadiyah 1 Yogyakarta adalah salah satu sekolah swasta
                  milik persyarikatan Muhammadiyah </p>
            </div>

            <div class="col-lg-2 pt-30">
               <p>Alamat</p>
               <div class="layanan">
                  <p>Jl. Gotongroyong I, Karangwaru, Kec. Tegalrejo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55241</p>
               </div>
            </div>
            <div class="col-lg-2 pt-30">
               <p>Kontak Kami</p>
               <span><i class="fa fa-whatsapp mr-10"></i>+62812 2000 1409</span><br>
               <span><i class="fa fa-envelope mr-10"></i>official@perpus.id</span><br>
            </div>
            <div class="col-lg-2 pt-30">
               <p>Jam Oprasional</p>
               <div class="layanan">
                  <p>Buka pukul 17.30</p>
                  <p>Tutup pukul 17.30</p>

               </div>
            </div>
            <div class="col-lg-3 pt-30">
               <p>Ikuti Kami</p>
               <div class="layanan">
                  <span class="fa-stack fa-lg">
                     <i class="fa fa-circle-thin fa-stack-2x"></i>
                     <i class="fa fa-facebook fa-stack-1x"></i>
                  </span>
                  <span class="fa-stack fa-lg">
                     <i class="fa fa-circle-thin fa-stack-2x"></i>
                     <i class="fa fa-instagram fa-stack-1x"></i>
                  </span>
                  <span class="fa-stack fa-lg">
                     <i class="fa fa-circle-thin fa-stack-2x"></i>
                     <i class="fa fa-youtube fa-stack-1x"></i>
                  </span>
                  <span class="fa-stack fa-lg">
                     <i class="fa fa-circle-thin fa-stack-2x"></i>
                     <i class="fa fa-linkedin fa-stack-1x"></i>
                  </span>
               </div>
            </div>
         </div>
      </section>
      <footer class="main-footer">
         <div class="container">
            <div class="pull-right hidden-xs">
               <img class="rocket-footer" src="<?= base_url('assets/') ?>dist/img/footer.svg" alt="">
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
            reserved.
         </div>
      </footer>
   </div>
   <!-- ./wrapper -->

   <!-- jQuery 3 -->
   <script src="<?= base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
   <!-- Bootstrap 3.3.7 -->
   <script src="<?= base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
   <!-- SlimScroll -->
   <script src="<?= base_url('assets/') ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
   <!-- FastClick -->
   <script src="<?= base_url('assets/') ?>bower_components/fastclick/lib/fastclick.js"></script>
   <!-- AdminLTE App -->
   <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="<?= base_url('assets/') ?>dist/js/demo.js"></script>
   <script>
      $(document).ready(function() {
         $(window).scroll(function() {
            if ($(this).scrollTop() > 50) { // Ganti 50 dengan nilai yang sesuai
               $('.navbar').addClass('bg-white');
            } else {
               $('.navbar').removeClass('bg-white');
            }
         });



         const items = $(".img-homepage");
         let currentIndex = 0;
         const totalItems = items.length;


         console.log(totalItems)
         // data.each
         function goToNextSlide() {
            currentIndex = (currentIndex + 1) % totalItems;
            updateActiveClass();
         }

         function updateActiveClass() {
            items.removeClass("active"); // Hapus kelas active dari semua elemen
            items.eq(currentIndex).addClass("active"); // Tambahkan kelas active ke elemen yang sedang ditunjuk
         }

         function goToPrevSlide() {
            currentIndex = (currentIndex - 1 + totalItems) % totalItems;
            updateActiveClass();
         }
         setInterval(goToNextSlide, 10000);



      });
   </script>
</body>

</html>