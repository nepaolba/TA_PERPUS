<body class="hold-transition skin-blue sidebar-mini fixed">
   <div class="wrapper">
      <header class="main-header" style="box-shadow: 0 2px 3px rgba(0,0,0,0.1);">
         <a href="index2.html" class="logo">
            <span class="logo-mini">
               <i class="fa fa-bank"></i>
            </span>
            <span class="logo-lg text-info"><i class="fa fa-bank text-aqua"></i> PERPUSTAKAAN <?= time_ago($this->session->userdata('dateLog')); ?></span>

         </a>
         <nav class="navbar navbar-static-top bg-white">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
               <ul class="nav navbar-nav">
                  <!-- <li class="dropdown notifications-menu"> -->
                  <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        <span class="label label-danger">10</span>
                     </a> -->
                  <!-- <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                           <ul class="menu">
                              <li>
                                 <a href="#">
                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                    page and may cause design problems
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    <i class="fa fa-user text-red"></i> You changed your username
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                     </ul> -->
                  </li>
                  <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url('assets/') ?>dist/img/avatar-1.png" class="user-image" alt="User Image">
                        <span class="hidden-xs" style="font-size: 12px;"><i class="fa fa-angle-down"></i></span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="user-header">
                           <img src="<?= base_url('assets/') ?>dist/img/avatar-1.png" class="img-circle" alt="User Image">
                           <p>
                              <?= nameLogin()[0] ?> - Administrator
                           </p>
                           <br><br>
                        </li>
                        <li class="user-footer">
                           <div class="">
                              <a href="<?= base_url('Auth/logout') ?>" class="btn btn-default btn-block btn-flat">Logout</a>
                           </div>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </nav>
      </header>