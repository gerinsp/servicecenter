<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">

         <?= $this->session->flashdata('message'); ?>
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1><?php echo $this->lang->line('change'); ?> Data Pelanggan</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Pelanggan</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid" style="padding-bottom: 70px;">
         <!-- SELECT2 EXAMPLE -->
         <div class="shadow card">
            <!-- /.card-header -->
            <div class="card-body">

               <form action="<?php echo base_url() . 'pelanggan/updatepelanggan'; ?> " enctype="multipart/form-data" method="post" accept-charset="utf-8" aria-hidden="true">
                  <?php foreach ($pelanggan as $data)
                  ?>
                  <h5>Data Pelanggan</h5>
                  <hr>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="bmd-label-floating">Nomor Service<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;" type="text" readonly name="nomorservice" class="form-control" value="<?= $data->nomorservicepelanggan ?>">
                           <input style="padding-bottom: 10px;max-width: 300px; margin-left: 70px;" type="hidden" value="<?= str_replace(array('=', '+', '/'), '', $this->encrypt->encode($data->id_pelanggan)) ?>" name="idpelanggan" class="form-control" required>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="bmd-label-floating">Nama Pelanggan<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;" type="text" required name="namapelanggan" class="form-control" value="<?= $data->namapelanggan ?>">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="bmd-label-floating">Merk Laptop<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;text-align:left" required type="text" name="merklaptop" class="form-control" value="<?= $data->merklaptop ?>">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="bmd-label-floating">Telepon (Whatsapp)<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;text-align:right" required type="number" name="telepon" class="form-control" value="<?= $data->telepon ?>">
                        </div>
                     </div>
                  </div>
                  <div class="row" style="margin-bottom: 20px;">
                     <div class="col-md-12">
                        <label>Keluhan <small class="text-danger">*</small></label>
                        <div class="form-group">
                           <textarea required style="padding-bottom: 10px;" rows="3" name="keluhan" class="form-control"><?= $data->keluhan ?></textarea>
                        </div>
                     </div>
                  </div>
                  <h5 style="margin-top: 30px;">Data Kelengkapan</h5>
                  <hr>
                  <div class="row">
                     <div class="col-md-6">

                        <div class="form-group">
                           <label class="bmd-label-floating">Kelengkapan</label><br>
                           <input style="padding-bottom: 10px;text-align:left" type="text" name="kelengkapan" class="form-control" value="<?= $data->kelengkapan ?>">
                        </div>
                     </div>
                     <!-- <div class="col-md-6">
                        <label class="bmd-label-floating">Opsional</label>
                        <input style="padding-bottom: 10px;text-align:right" required type="number" name="kelengkapanopsional" class="form-control" value="<?= set_value('kelengkapanopsional') ?>">
                     </div> -->
                  </div>
                  <h5 style="margin-top: 30px;">Data Laptop</h5>
                  <hr>

                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Layar<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;text-align:left" required type="text" name="layar" class="form-control" value="<?= $data->layar ?>">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Keyboard<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;text-align:left" required type="text" name="keyboard" class="form-control" value="<?= $data->keyboard ?>">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Speaker<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;text-align:left" required type="text" name="speaker" class="form-control" value="<?= $data->speaker ?>">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Batrei<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;text-align:left" required type="text" name="batrei" class="form-control" value="<?= $data->batrei ?>">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Casing<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;text-align:left" required type="text" name="casing" class="form-control" value="<?= $data->casing ?>">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Touchpad<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;text-align:left" required type="text" name="touchpad" class="form-control" value="<?= $data->touchpad ?>">
                        </div>
                     </div>
                  </div>
                  <button type="submit" id="btnsavepelanggan" class="btn btn-info pull-right"><?php echo $this->lang->line('change'); ?></button>
                  <a href="<?= base_url('listpelanggan'); ?>" class="btn btn-danger" role="button" title="Kembali"> <?php echo $this->lang->line('back'); ?> </a>

               </form>
            </div>
         </div>
         <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>

<!-- Function Javascript -->
<script>
</script>
<!-- End Function Javascript -->