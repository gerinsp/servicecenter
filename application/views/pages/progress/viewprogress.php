  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
        <div class="container-fluid">
           <div class="row mb-2">
              <div class="col-sm-6">
                 <h1 class="m-0">Progress Service</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Progress</li>
                 </ol>
              </div><!-- /.col -->
           </div><!-- /.row -->
        </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->
     <section class="content-header">
        <div class="continer-fluid">
           <div class="row">
              <div class="col-md-12">
                 <div class="input-group">
                    <input style="max-width: 290px;" placeholder="<?php echo $this->lang->line('search'); ?> Nomor Service" type="text" name="nomorservice" id="nomorservice" class="form-control">

                    <button style="margin-left: 3px;" type="button" class="btn btn-success btn-flat" onclick="caribarang()"><?php echo $this->lang->line('search'); ?></button>
                 </div>

              </div>
           </div>
        </div>
     </section>
     <!-- Main content -->

     <section class="content">
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
           url: "<?php echo base_url("service/searchdata"); ?>",
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