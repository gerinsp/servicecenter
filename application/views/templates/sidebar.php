<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <!-- <a href="index3.html" class="brand-link">
      <img src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
   </a> -->

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="<?= base_url('assets/img/profile/') . $user->image ?>" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
            <a href="#" class="d-block"><?= $user->nama ?></a>
         </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
         <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
               <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
               </button>
            </div>
         </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
               <a href="<?= base_url('dashboard') ?>" class="nav-link <?php if ($this->uri->segment(1) == "dashboard") {
                                                                           echo "active";
                                                                        } ?>"">
                  <i class=" nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <!-- Menu Untuk Role Owner -->
            <?php if ($user->role_id == 1) { ?>
               <li class="nav-header"> Master</li>
               <li class="nav-item">
                  <a href="<?= base_url('listadmin') ?>" class="nav-link  <?php if ($this->uri->segment(1) == "listadmin") {
                                                                           } ?>">
                     <i class="nav-icon fas fa-tv"></i>
                     <span>Admin</span></a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url('listteknisi') ?>" class="nav-link  <?php if ($this->uri->segment(1) == "listteknisi") {
                                                                                 echo "active";
                                                                              } ?><?php if ($this->uri->segment(1) == "tambahdatateknisi") {
                                                                                       echo "active";
                                                                                    } ?><?php if ($this->uri->segment(1) == "editdatateknisi") {
                                                                                             echo "active";
                                                                                          } ?>">
                     <i class="nav-icon fas fa-user-cog"></i>
                     <span>Teknisi</span></a>
               </li>
               <li class="nav-header"> Progress</li>
               <li class="nav-item">
                  <a href="<?= base_url('viewprogress') ?>" class="nav-link  <?php if ($this->uri->segment(1) == "viewprogress") {
                                                                                 echo "active";
                                                                              } ?>">
                     <i class="nav-icon fas fa-bars"></i>
                     <span>Progress</span></a>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url('listservice') ?>" class="nav-link  <?php if ($this->uri->segment(1) == "listservice") {
                                                                                 echo "active";
                                                                              } elseif ($this->uri->segment(1) == "detaildataservice") {
                                                                                 echo "active";
                                                                              } ?>">
                     <i class="nav-icon fas fa-book"> </i>
                     <span>Data Service</span></a>
               </li>

               <!-- <li class="nav-header"> Pelanggan</li>
               <li class="nav-item">
                  <a class="nav-link  <?php if ($this->uri->segment(1) == "listpelanggan") {
                                          echo "active";
                                       } ?>">
                     <i class="nav-icon fas fa-users"></i>
                     <span>Pelanggan</span></a>
               </li> -->
            <?php } ?>

            <!-- Menu Untuk Role Admin -->
            <?php if ($user->role_id == 2) { ?>
               <li class="nav-header"> Pelanggan</li>
               <li class="nav-item">
                  <a class="nav-link  <?php if ($this->uri->segment(1) == "listpelanggan") {
                                          echo "active";
                                       } elseif ($this->uri->segment(1) == "tambahdatapelanggan") {
                                          echo "active";
                                       } elseif ($this->uri->segment(1) == "editdatapelanggan") {
                                          echo "active";
                                       } elseif ($this->uri->segment(1) == "detaildatapelanggan") {
                                          echo "active";
                                       } ?>" href="<?= base_url('listpelanggan') ?>">
                     <i class="nav-icon fas fa-users"></i>
                     <span>Pelanggan</span></a>
               </li>
               <li class="nav-header"> Report</li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="modal" data-target="#modalreport">
                     <i class="nav-icon fas fa-print"></i>
                     <span>Rekap Data Service</span></a>
               </li>
            <?php } ?>


            <!-- Menu Untuk Role Teknisi -->
            <?php if ($user->role_id == 3) { ?>
               <li class="nav-header"> Progress</li>
               <li class="nav-item">
                  <a href="<?= base_url('listservice') ?>" class="nav-link   <?php if ($this->uri->segment(1) == "viewprogress") {
                                                                                 echo "active";
                                                                              } ?>">
                     <i class="nav-icon fas fa-bars"></i>
                     <span>Progress</span></a>
               </li>
            <?php } ?>

            <!-- Menu Untuk Role Pelanggan -->
            <?php if ($user->role_id == 4) { ?>
               <li class="nav-header"> Progress</li>
               <li class="nav-item">
                  <a href="<?= base_url('viewprogress') ?>" class="nav-link  <?php if ($this->uri->segment(1) == "viewprogress") {
                                                                                 echo "active";
                                                                              } ?>">
                     <i class="nav-icon fas fa-bars"></i>
                     <span>Progress</span></a>
               </li>
            <?php } ?>

            <li class="nav-header">Profil</li>
            <li class="nav-item">
               <a href="<?= base_url('profile') ?>" class="nav-link <?php if ($this->uri->segment(1) == "profile") {
                                                                        echo "active";
                                                                     } ?>">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Profil</p>
               </a>
            </li>
            <li class="nav-header">Keluar</li>
            <li class="nav-item">
               <a href="#" data-toggle="modal" data-target="#logoutModal" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Logout</p>
               </a>
            </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>