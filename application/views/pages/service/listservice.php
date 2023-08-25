<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Data Service</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Data Service</li>
               </ol>
            </div>
         </div>

      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content" style="padding-bottom: 70px;">
      <div id="tampil"></div>
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">

               <!-- /.card -->

               <div class="shadow card">

                  <!-- /.card-header -->
                  <div class="card-body">
                     <?php if ($user->role_id == 1) { ?>
                        <h6 class="m-0 font-weight-bold text-primary"> <a class="text-info" style="text-decoration: none;" class="collapse-item" href="<?php echo base_url() ?>tambahdatapelanggan"> <i class="fas fa-fw fa-plus text-info"></i> <?php echo $this->lang->line('add'); ?> Data Pelanggan</h6></a>
                     <?php } ?>
                     <br>
                     <div class="table-responsive">
                        <table style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" class="table tablelist table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                           <thead>
                              <tr height="20px">
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Pelanggan</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Merk Laptop</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Status Services</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Keluhan</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('pengaturan'); ?></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $no = 1;
                              foreach ($read as $data) {
                                 if ($data->status == "1") {
                                    $st = "Unit Masuk";
                                 }
                                 if ($data->status == "2") {
                                    $st = "Diagnosis";
                                 }
                                 if ($data->status == "3") {
                                    $st = "Persiapan";
                                 }
                                 if ($data->status == "4") {
                                    $st = "Pengerjaan";
                                 }
                                 if ($data->status == "5") {
                                    $st = "Selesai";
                                 }
                                 if ($data->status == "6") {
                                    $st = "Batal Service";
                                 }
                              ?>
                                 <tr id="pelanggan<?= $data->id_pelanggan ?>">
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="5%"><?php echo $no ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->namapelanggan ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->merklaptop ?></td>
                                    <?php if ($st == "Unit Masuk") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Diagnosis") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:orange" width="20%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Persiapan") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:yellow" width="20%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Pengerjaan") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:blue" width="20%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Selesai") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:green" width="20%"><?php echo $st ?></td>
                                    <?php }
                                    if ($st == "Batal Service") { ?>
                                       <td style="vertical-align: top;border-top: 1px solid #e3e6f0;color:red" width="20%"><?php echo $st ?></td>
                                    <?php } ?>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%">
                                       <textarea style="padding-top: 0px;text-align:justify; padding:0px;font-size: 18px;width:500px;background: transparent; border: none;font-size: 18px;overflow:hidden;color:black" class="keluhanringkas" disabled rows="3"><?= substr($data->keluhan, 0, 100) ?>...</textarea>
                                       <textarea class="keluhanlengkap" style="padding-top: 0px;text-align:justify; padding:0px;font-size: 18px;width:500px;display:none;background: transparent; border: none;font-size: 18px;color:black;" disabled><?= $data->keluhan ?></textarea><br>

                                       <a href="" onclick="tampilkeluhan(this)" class="lihatselengkapnya" style="margin-bottom: 10px;width: 80px;color: #858796"> <b>Lihat Selengkapnya</b></a>
                                       <a href="" onclick="tutupkeluhan(this)" class="persingkatkeluhan" style="margin-bottom: 10px;width: 80px;color: #858796;display:none"> <b>Tutup Keluhan</b></a>
                                    </td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%">
                                       <?php if ($user->role_id == 1) { ?>
                                          <a style="margin-bottom: 10px; width:80px" href="<?= base_url('detaildataservice/' . str_replace(array('=', '+', '/'), '', $this->encrypt->encode($data->id_pelanggan))); ?>" class="btn btn-sm btn-primary" role="button" title="Detail"><i class="fas fa-fw fa-search"></i> Detail </a>
                                       <?php } ?>
                                       <?php if ($user->role_id == 3) { ?>
                                          <a style="margin-bottom: 10px; width:80px" href="<?= base_url('detaildataservice/' . str_replace(array('=', '+', '/'), '', $this->encrypt->encode($data->id_pelanggan))); ?>" class="btn btn-sm btn-primary" role="button" title="Detail"> Update Status </a>
                                       <?php } ?>
                                    </td>
                                 </tr>
                              <?php
                                 $no++;
                              }
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Function Javascript -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<script>
   function autoResizeTextarea(element) {
      element.style.height = "auto";
      element.style.height = element.scrollHeight + "px";
   }

   function tampilkeluhan(element) {

      $(document).on('click', element, function(e) {
         e.preventDefault();
         let tampilkeluhanlengkap = document.querySelector(`tr#${event.target.parentNode.parentNode.parentNode.id} textarea[class=keluhanlengkap]`)
         let tampilkeluhanringkas = document.querySelector(`tr#${event.target.parentNode.parentNode.parentNode.id} textarea[class=keluhanringkas]`)
         let lihatselengkapnya = document.querySelector(`tr#${event.target.parentNode.parentNode.parentNode.id} a[class=lihatselengkapnya]`)
         let persingkatkeluhan = document.querySelector(`tr#${event.target.parentNode.parentNode.parentNode.id} a[class=persingkatkeluhan]`)

         tampilkeluhanringkas.style.display = "none";
         lihatselengkapnya.style.display = "none";
         tampilkeluhanlengkap.style.display = "";
         persingkatkeluhan.style.display = "";

         autoResizeTextarea(tampilkeluhanlengkap);
      });
   }

   function tutupkeluhan(element) {
      $(document).on('click', element, function(e) {
         e.preventDefault()
         let tampilkeluhanlengkap = document.querySelector(`tr#${event.target.parentNode.parentNode.parentNode.id} textarea[class=keluhanlengkap]`)
         let tampilkeluhanringkas = document.querySelector(`tr#${event.target.parentNode.parentNode.parentNode.id} textarea[class=keluhanringkas]`)
         let lihatselengkapnya = document.querySelector(`tr#${event.target.parentNode.parentNode.parentNode.id} a[class=lihatselengkapnya]`)
         let persingkatkeluhan = document.querySelector(`tr#${event.target.parentNode.parentNode.parentNode.id} a[class=persingkatkeluhan]`)


         tampilkeluhanringkas.style.display = "";
         lihatselengkapnya.style.display = "";
         tampilkeluhanlengkap.style.display = "none";
         persingkatkeluhan.style.display = "none";
      });

   }
</script>
<!-- End Function Javascript -->