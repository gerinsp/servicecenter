<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">

         <?= $this->session->flashdata('message'); ?>
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Detail Data Service</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Service</li>
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


               <?php foreach ($service as $data)
               ?>
               <h5>Data Pelanggan</h5>
               <hr>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="bmd-label-floating">Nomor Service<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;" type="text" readonly name="nomorservice" class="form-control" value="<?= $data->nomorservicepelanggan ?>">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="bmd-label-floating">Nama Pelanggan<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;" type="text" readonly required name="namapelanggan" class="form-control" value="<?= $data->namapelanggan ?>">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="bmd-label-floating">Merk Laptop<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;text-align:left" required type="text" name="merklaptop" class="form-control" readonly value="<?= $data->merklaptop ?>">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="bmd-label-floating">Telepon (Whatsapp)<small class="text-danger">*</small></label>
                        <input readonly style="padding-bottom: 10px;text-align:right" required type="number" name="telepon" class="form-control" value="<?= $data->telepon ?>">
                     </div>
                  </div>
               </div>
               <div class="row" style="margin-bottom: 20px;">
                  <div class="col-md-12">
                     <label>Keluhan <small class="text-danger">*</small></label>
                     <div class="form-group">
                        <textarea readonly required style="padding-bottom: 10px;" rows="3" name="keluhan" class="form-control"><?= $data->keluhan ?></textarea>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="bmd-label-floating">Diagnosis<small class="text-danger">*</small></label>
                        <textarea readonly required style="padding-bottom: 10px;" rows="3" name="diagnosis" class="form-control"><?= $data->diagnosis ?></textarea>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="bmd-label-floating">Keterangan<small class="text-danger">*</small></label>
                        <textarea readonly required style="padding-bottom: 10px;" rows="3" name="keterangan" class="form-control"><?= $data->persiapan ?></textarea>
                     </div>
                  </div>
               </div>
               <h5 style="margin-top: 30px;">Data Kelengkapan</h5>
               <hr>
               <div class="row">
                  <div class="col-md-6">

                     <div class="form-group">
                        <input readonly style="padding-bottom: 10px;text-align:right" required readonly type="text" name="kelengkapan" class="form-control" value="<?= $data->kelengkapan ?>">
                     </div>
                  </div>
               </div>
               <h5 style="margin-top: 30px;">Data Laptop</h5>
               <hr>

               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label class="bmd-label-floating">Layar<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;text-align:left" required type="text" name="layar" class="form-control" readonly value="<?= $data->layar ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label class="bmd-label-floating">Keyboard<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;text-align:left" required type="text" name="keyboard" class="form-control" readonly value="<?= $data->keyboard ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label class="bmd-label-floating">Speaker<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;text-align:left" required type="text" name="speaker" class="form-control" readonly value="<?= $data->speaker ?>">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label class="bmd-label-floating">Batrei<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;text-align:left" required type="text" name="batrei" class="form-control" readonly value="<?= $data->batrei ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label class="bmd-label-floating">Casing<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;text-align:left" required type="text" name="casing" class="form-control" readonly value="<?= $data->casing ?>">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label class="bmd-label-floating">Touchpad<small class="text-danger">*</small></label>
                        <input style="padding-bottom: 10px;text-align:left" required type="text" name="touchpad" class="form-control" readonly value="<?= $data->touchpad ?>">
                     </div>
                  </div>
               </div>
               <?php if ($user->role_id == 3) { ?>
                  <h5 style="margin-top: 30px;">Update Status</h5>
                  <hr>
                  <form action="<?= base_url('updatestatus/' . $data->id_barang) ?>" method="post">
                     <div class="row mb-4">
                        <div class="col-md-4">
                           <div class="form-group">
                              <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $data->id_pelanggan ?>">
                              <label class="bmd-label-floating">Status</label>
                              <select class="form-control" name="status" id="status">
                                 <?php if ($data->status == 1) { ?>
                                    <option value="1">Unit Masuk</option>
                                    <option value="2">Unit Diagnosis</option>
                                    <option value="4" disabled style="background-color:gainsboro;">Pengerjaan</option>
                                    <option value="5" disabled style="background-color:gainsboro;">Selesai</option>
                                 <?php } ?>

                                 <?php if ($data->status == 2) { ?>
                                    <option value="1" disabled style="background-color:gainsboro;">Unit Masuk</option>
                                    <option value="2">Unit Diagnosis</option>
                                    <option value="4" disabled style="background-color:gainsboro;">Pengerjaan</option>
                                    <option value="5" disabled style="background-color:gainsboro;">Selesai</option>
                                 <?php } ?>

                                 <?php if ($data->status == 3) { ?>
                                    <option value="1" disabled style="background-color:gainsboro;">Unit Masuk</option>
                                    <option value="2" disabled style="background-color:gainsboro;">Unit Diagnosis</option>
                                    <option value="4">Pengerjaan</option>
                                    <option value="5" disabled style="background-color:gainsboro;">Selesai</option>
                                 <?php } ?>

                                 <?php if ($data->status == 4) { ?>
                                    <option value="1" disabled style="background-color:gainsboro;">Unit Masuk</option>
                                    <option value="2" disabled style="background-color:gainsboro;">Unit Diagnosis</option>
                                    <option value="4">Pengerjaan</option>
                                    <option value="5">Selesai</option>
                                 <?php } ?>
                                 <?php if ($data->status == 5) { ?>
                                    <option value="1" disabled style="background-color:gainsboro;">Unit Masuk</option>
                                    <option value="2" disabled style="background-color:gainsboro;">Unit Diagnosis</option>
                                    <option value="4" disabled style="background-color:gainsboro;">Pengerjaan</option>
                                    <option value="5">Selesai</option>
                                 <?php } ?>
                                 <?php if ($data->status == 6) { ?>
                                    <option value="1" disabled style="background-color:gainsboro;">Unit Masuk</option>
                                    <option value="2" disabled style="background-color:gainsboro;">Unit Diagnosis</option>
                                    <option value="4" disabled style="background-color:gainsboro;">Pengerjaan</option>
                                    <option value="5" disabled style="background-color:gainsboro;">Selesai</option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <?php if ($data->status == 5 || $data->status == 6) { ?>
                              <button type="submit" class="btn btn-primary" style="margin-top: 32px;" disabled>Simpan</button>
                           <?php } else { ?>
                              <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Simpan</button>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="row mb-4 " id="ket">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="bmd-label-floating" id="label-diag">Diagnosis</label>
                              <textarea class="form-control" name="diagnosis" id="diagnosis" cols="30" rows="5"><?= $data->diagnosis ?></textarea>

                           </div>
                        </div>
                     </div>
                  </form>
               <?php } ?>
               <a href="<?= base_url('listservice'); ?>" class="btn btn-danger" role="button" title="Kembali"> <?php echo $this->lang->line('back'); ?> </a>
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
   const ket = document.getElementById('ket'),
      diagnosis = document.getElementById('diagnosis'),
      labeldiag = document.getElementById('label-diag'),
      status = document.getElementById('status');

   console.log(status.value)

   if (status.value != 2 && status.value != 3) {
      ket.style.display = 'none'
   }

   if (status.value == 2) {
      diagnosis.style.display = 'block'
      labeldiag.style.display = 'block'
   }
   status.addEventListener('change', () => {
      console.log(status.value)
      if (status.value == 2) {
         ket.style.display = 'block'
         if (status.value == 2) {
            diagnosis.style.display = 'block'
            labeldiag.style.display = 'block'
            diagnosis.required = true
            labeldiag.innerText = 'Diagnosis'
            diagnosis.value = '<?= $data->diagnosis ?>'
         }
      } else {
         ket.style.display = 'none'
      }
   })
</script>
<!-- End Function Javascript -->