<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?= $title ?></title>

   <link rel="icon" href="<?= base_url('assets/img/favicon.ico') ?>" type="image/x-icon">

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
   <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
   <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
   <!-- summernote -->
   <link rel="stylesheet" href="<?= base_url('assets/plugins/summernote/summernote-bs4.min.css') ?>">
   <!-- lightbox -->
   <link rel="stylesheet" href="<?= base_url('assets/plugins/ekko-lightbox/ekko-lightbox.css') ?>">

   <!-- <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.css') ?>"></script> -->
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <!-- Select2 -->
   <!--<link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">-->
   <!--<link rel="stylesheet" href="<?= base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>"> -->

   <!--Instascan -->
   <script src="<?= base_url('assets/plugins/instascan/instascan.min.js') ?>"></script>
   <!-- Webcam -->
   <script type="text/javascript" src="<?= base_url('assets/plugins/webcamjs/webcam.min.js') ?>"></script>

   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css') ?>">

</head>

<body>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper" style="margin-left: 0px;">
      <!-- Content Header (Page header) -->
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div><!-- /.col -->
               <div class="col-sm-6">
               </div><!-- /.col -->
            </div><!-- /.row -->
         </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row justify-content-center">
               <div class="col-md-12">
                  <div class="text-center mb-5">
                     <img width="200" src="<?= base_url('assets/img/logo.jpeg') ?>" alt="">
                  </div>
                  <div class="text-center">
                     <h1 class="mb-4">Cek Progress Service</h1>

                     <!-- Tambahkan class d-flex dan justify-content-center untuk mengakses pusat input group -->
                     <div class="input-group d-flex justify-content-center">
                        <input style="max-width: 400px; height:50px" placeholder="<?php echo $this->lang->line('search'); ?> Nomor Service" type="text" name="nomorservice" id="nomorservice" class="form-control">
                        <button style="margin-left: 3px; width:60px" type="button" class="btn btn-success btn-flat" onclick="caribarang()"><?php echo $this->lang->line('search'); ?></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>



      <!-- Main content -->

      <section class="content mt-5">
         <div class="container-fluid">
            <div id="progressbar"></div>
         </div>

      </section>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

   <!-- FUNCTION JAVASCRIPT -->
   <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
   <!-- jQuery UI 1.11.4 -->
   <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
   <script>
      function caribarang() {
         var nomorservice = $('#nomorservice').val();
         $.ajax({
            url: "<?php echo base_url("cekservice/searchdata"); ?>",
            type: "POST",
            data: {
               nomorservice: nomorservice,
            },
            success: function(data) {
               $('#progressbar').html(data);
            }
         });
      }
   </script>
   <!-- END FUNCTION JAVASCRIPT -->