<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>PERPUSTAKAAN | Dashboard</title>
   <link rel="icon" href="<?= base_url('assets/') ?>dist/img/logo.png" type="image/x-icon">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/Ionicons/css/ionicons.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/morris.js/morris.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css">
   <!-- <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->
   <!-- <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/toastr/toastr.min.css"> -->
   <!-- <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/jvectormap/jquery-jvectormap.css"> -->
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
   <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/timepicker/bootstrap-timepicker.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/iCheck/all.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/select2/dist/css/select2.min.css">

   <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/AdminLTE.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/skins/_all-skins.min.css">
   <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,800;1,900&display=swap" rel="stylesheet">
   <style>
      body {
         font-family: 'Rubik', sans-serif;
         /* font-weight: 100; */
         font-size: 12px;
      }

      .treeview-menu>li>a {
         font-size: 12px;
      }


      .sidebar-menu>li>a>.fa,
      .sidebar-menu>li>a>.glyphicon,
      .sidebar-menu>li>a>.ion {
         font-size: 15px;
      }


      /* label {
         font-weight: 400;
      } */

      label {
         text-transform: uppercase;
         font-size: 9px;
         font-weight: 500;
      }

      label.error {
         color: #a94442;
         font-size: 9px;
         text-transform: capitalize;
         font-weight: 400;
      }


      /* .swal2-popup {
         display: flex !important;
         align-items: center;
         width: auto !important;
      }

      .custom-swal2-popup {
         display: grid !important;
         width: 32em !important;
      }

      .swal2-popup.swal2-toast .swal2-title {
         font-size: 1rem;
         font-weight: 400;
      }

      .swal2-popup.swal2-toast {
         font-size: 1.5rem;
      } */
      .swal2-title {
         font-size: 2.5rem !important;
      }

      .swal2-popup {
         font-size: 1.5rem;
      }

      .form-control {
         font-size: 11px;
         border-radius: 5px;
      }

      .select2-container--default .select2-selection--single,
      .select2-selection .select2-selection--single {
         border-radius: 5px;
      }

      th {
         font-size: 9.5px !important;
         font-weight: 500;
         text-transform: uppercase;
      }

      td {
         font-size: 11px;
      }

      .cursor-pointer {
         cursor: pointer;
      }

      .select2 {
         font-size: 11px;
      }

      .logo {
         font-family: 'Rubik' !important;
      }


      .user-panel>.info>p {
         font-weight: 300;
      }

      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      .h1,
      .h2,
      .h3,
      .h4,
      .h5,
      .h6 {
         font-family: 'Rubik', sans-serif;
         font-weight: 300;
      }

      .small-box {
         border-radius: 5px;
      }

      .small-box-footer {
         border-bottom-left-radius: 5px;
         border-bottom-right-radius: 5px;
      }

      .modal-footer {
         text-align: center !important;
         border-top: none;
      }

      .bg-pemberitahuan {
         background-color: #f7be65;
         color: white
      }

      .alert>ul>li {
         font-size: 12px;
      }

      .overflow-hidden {
         overflow: hidden;
      }

      .position-relative {
         position: relative;
      }

      .d-flex {
         display: flex;
      }

      .justify-content-center {
         justify-content: center;

      }

      .justify-content-between {
         justify-content: space-between
      }

      .align-items-center {
         align-items: center;
      }

      .flex-direction-column {
         flex-direction: column
      }

      /* #image-preview {

         background-color: darkslategrey;
         margin: 0;
         padding: 0;
         border-radius: 10px;
         padding: 5px;

      } */

      #image-preview img {
         max-width: 300px;
         max-height: 300px;
         width: 100%;
         height: 100%;
         /* border-radius: 10px; */
         object-fit: cover;
         object-position: center;
      }

      #foto {
         cursor: pointer;
      }

      .d-none {
         display: none !important;
      }

      .new-shadow {
         box-shadow: 3px 3px 11px 0px rgba(0, 0, 0, 0.1);
      }

      .bg-white {
         background: #FFFF !important;
      }

      .ml-0 {
         margin-left: 0 !important;
      }

      .fs-12 {
         font-size: 12px !important;
      }

      .skin-blue .main-header .logo {
         background-color: #FFFF;
         color: #262626;
         border-bottom: 0 solid transparent;
      }

      .skin-blue .main-sidebar {
         background-color: #FFFF;
      }

      .skin-blue .sidebar a {
         color: #5a6164;
      }

      .skin-blue .sidebar-menu .treeview-menu>li>a {
         color: #5a6164;
      }

      .skin-blue .sidebar-menu>li:hover>a,
      .skin-blue .sidebar-menu>li.active>a,
      .skin-blue .sidebar-menu>li.menu-open>a {
         color: #605ca8;
         background: #ecf0f5;
      }

      .skin-blue .sidebar-menu>li.active>a {
         border-left-color: #605ca8;
      }

      .skin-blue .sidebar-menu .treeview-menu>li.active>a,
      .skin-blue .sidebar-menu .treeview-menu>li>a:hover {
         color: #605ca8;
      }

      .skin-blue .sidebar-menu>li.header {
         color: #4b646f;
         background: #ecf0f5ab;

      }

      .skin-blue .sidebar-menu>li>.treeview-menu {
         margin: 0 1px;
         background: #ecf0f5;
      }

      .skin-blue .main-header .navbar .sidebar-toggle {
         color: #454444;
      }

      .skin-blue .main-header .navbar .nav>li>a {
         color: #454444;
         font-size: 14px;
      }


      .skin-blue .main-header .navbar .nav>li>a:hover,
      .skin-blue .main-header .navbar .nav>li>a:active,
      .skin-blue .main-header .navbar .nav>li>a:focus,
      .skin-blue .main-header .navbar .nav .open>a,
      .skin-blue .main-header .navbar .nav .open>a:hover,
      .skin-blue .main-header .navbar .nav .open>a:focus,
      .skin-blue .main-header .navbar .nav>.active>a {
         color: #262626;
      }

      .skin-blue .main-header .navbar .sidebar-toggle:hover {
         background-color: #edf0f2;
      }

      .skin-blue .main-header .navbar .sidebar-toggle:hover {
         color: #262626;
         background: rgba(0, 0, 0, 0.1);
      }

      .skin-blue .main-header .logo:hover {
         background-color: #edf0f2;
      }

      .main-footer {
         background-color: #ecf0f5;
         border-top: none;
         text-align: center;
      }

      .buku img {
         border-radius: 5px;
         border: 5px solid #80808042;
         padding: 2px;
         object-fit: cover;
         object-position: top center;
      }

      .mb2 {
         margin-bottom: 2px;
      }

      .mt5 {
         margin-top: 5px;
      }

      .alert-custom {
         background-color: #00c0ef29 !important;
         color: #262626 !important;
      }

      /* Palet warna */
      /* 
      .bg-primary {
         background-color: #00bff3;
         color: #FFF;
      }

      .text-primary {
         color: #00bff3;
      }

      .bg-success {
         background-color: #1cbbb4;
         color: #FFF;
      }

      .text-success {
         color: #1cbbb4;
      }

      .bg-warning {
         background-color: #fbaf5d;
         color: #FFF;
      }

      .text-warning {
         color: #fbaf5d;
      }

      .bg-danger {
         background-color: #f26d7d;
         color: #FFF;
      }

      .text-danger {
         color: #f26d7d;
      } */



      /* 
      .skin-blue .main-header .navbar {
         background-color: #9d9a9d;
      } */



      /* .skin-blue .main-header .navbar {
         background: url('assets/dist/img/header.png');top 
      } */
      .dataTables_filter {
         display: flex;
         align-items: center;
         /* Untuk memusatkan vertikal */
      }

      .dataTables_filter input {
         flex: 1;
         /* Membuat input fleksibel agar mengisi ruang yang tersedia */
         min-width: 150px;
         /* Setel lebar minimum jika diperlukan */
         max-width: 100%;
         /* Menghindari input melebihi lebar kontainer */
      }

      .dataTables_filter .form-control {
         width: 100%;
         /* Input menyesuaikan dengan lebar kontainer */
      }
   </style>
</head>