<aside class="main-sidebar bg-ketiga">
   <section class="sidebar">
      <div class="user-panel">
         <div class="pull-left image">
            <img src="<?= base_url('assets/') ?>dist/img/petugas/<?= nameLogin()[1] ?>" class="img-circle" alt="User Image">
         </div>
         <div class="pull-left info">
            <p class="text-navy"><?= nameLogin()[0] ?></p>
            <a href="#" class="text-blue"><i class="fa fa-check-circle text-primary"></i> Administrator</a>
         </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         <li class="header">MENU UMUM</li>

         <li <?= $this->uri->segment(1) == "" || $this->uri->segment(1) == "Admin" ? "class='active'" : "" ?>>
            <a href="<?= base_url('Admin') ?>">
               <i class="fa fa-th-large"></i>
               <span>Dashboard</span>
            </a>
         </li>

         <li class="treeview <?= $this->uri->segment(1) == "Peminjaman" || $this->uri->segment(1) == "Pengembalian" ? "active" : "" ?>">
            <a href="#">
               <i class="fa fa-compress"></i> <span>Transaksi</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li <?= $this->uri->segment(1) == "Peminjaman" ? "class='active'" : "" ?>><a href="<?= base_url('Peminjaman') ?>"><i class="fa fa-circle-o"></i> Peminjaman</a></li>
               <li <?= $this->uri->segment(1) == "Pengembalian" ? "class='active'" : "" ?>><a href="<?= base_url('Pengembalian') ?>"><i class="fa fa-circle-o"></i> Pengembalian</a></li>
               <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Pengembalian</a></li> -->
            </ul>
         </li>
         <li class="treeview">
            <a href="#">
               <i class="fa  fa-file-text"></i> <span>Laporan</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="#"><i class="fa fa-circle-o"></i> Peminjaman</a></li>
               <li><a href="#"><i class="fa fa-circle-o"></i> Pengembalian</a></li>
            </ul>
         </li>
         <li class="header">MASTER DATA</li>
         <li <?= $this->uri->segment(1) == "Anggota" ? "class='active'" : "" ?>><a href="<?= base_url('Anggota') ?>"><i class="ion ion-person-stalker"></i> <span>Anggota</span></a></li>
         <li <?= $this->uri->segment(1) == "Petugas" ? "class='active'" : "" ?>><a href="<?= base_url('Petugas') ?>"><i class="ion ion-person-stalker"></i> <span>Petugas</span></a></li>
         <li <?= $this->uri->segment(1) == "Rak" ? "class='active'" : "" ?>><a href="<?= base_url('Rak') ?>"><i class="fa fa-folder-open"></i> Rak Buku</a></li>
         <li <?= $this->uri->segment(1) == "Kategori" ? "class='active'" : "" ?>><a href="<?= base_url('Kategori') ?>"><i class="fa fa-list-ul"></i> Kategori Buku</a></li>
         <li <?= $this->uri->segment(1) == "Buku" || $this->uri->segment(2) == "tambahBuku" ? "class='active'" : "" ?>><a href="<?= base_url('Buku') ?>"><i class="fa fa-book"></i> Data Buku</a></li>







         <!-- <li><a href="#"><i class="fa fa-money text-maroon"></i> <span>Denda</span></a></li> -->
         <li class="header">PENGATURAN</li>
         <li><a href="#"><i class="fa fa-bank"></i> <span>Profil Perpus</span></a></li>
         <li><a href="#"><i class="ion ion-person  "></i> <span>Akun</span></a></li>

      </ul>
   </section>
</aside>