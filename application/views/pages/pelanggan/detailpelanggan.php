<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">

         <?= $this->session->flashdata('message'); ?>
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Detail Data Pelanggan</h1>
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


               <?php foreach ($pelanggan as $data)
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
               <?php if ($user->role_id == 2) { ?>
                  <h5 style="margin-top: 30px;">Update Status</h5>
                  <hr>
                  <form action="<?= base_url('updatestatus/' . $data->id_barang) ?>" method="post">
                     <div class="row mb-4">
                        <div class="col-md-4">
                           <div class="form-group">
                              <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $data->id_pelanggan ?>">
                              <input type="hidden" name="diagnosis" value="<?= $data->diagnosis ?>">
                              <label class="bmd-label-floating">Status</label>
                              <select class="form-control" name="status" id="status">
                                 <?php if ($data->status != 5 && $data->status != 2 && $data->status != 3) { ?>
                                    <option value="2" disabled style="background-color:gainsboro;">Unit Diagnosis</option>
                                    <option value="3" disabled style="background-color:gainsboro;">Persiapan</option>
                                    <option value="6" disabled style="background-color:gainsboro;">Batal Service</option>
                                    <option value="5" disabled style="background-color:gainsboro;">Selesai</option>
                                 <?php } elseif ($data->status == 2) { ?>
                                    <option value="2">Unit Diagnosis</option>
                                    <option value="3">Persiapan</option>
                                    <option value="6">Batal Service</option>
                                    <option value="5" disabled style="background-color:gainsboro;">Selesai</option>
                                 <?php } elseif ($data->status == 3) { ?>
                                    <option value="2" disabled style="background-color:gainsboro;">Unit Diagnosis</option>
                                    <option value="3">Persiapan</option>
                                    <option value="6" disabled style="background-color:gainsboro;">Batal Service</option>
                                    <option value="5" disabled style="background-color:gainsboro;">Selesai</option>
                                 <?php } else { ?>
                                    <option value="2" disabled style="background-color:gainsboro;">Unit Diagnosis</option>
                                    <option value="3" disabled style="background-color:gainsboro;">Persiapan</option>
                                    <option value="6" disabled style="background-color:gainsboro;">Batal Service</option>
                                    <option value="5">Selesai</option>
                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <?php if ($data->status != 5 && $data->status != 2 && $data->status != 3) { ?>
                              <button type="submit" class="btn btn-primary" style="margin-top: 32px;" disabled>Simpan</button>
                           <?php } elseif ($data->status == 2) { ?>
                              <button type="submit" id="btn-wa" class="btn btn-primary" style="margin-top: 32px;">Kirim WA</button>
                           <?php } else { ?>
                              <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Kirim WA</button>
                           <?php } ?>
                        </div>
                     </div>

                     <?php if ($data->status == 2 || $data->status == 3) { ?>
                        <div class="row mb-4 " id="ket">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="bmd-label-floating" id="label-diag">Diagnosis</label>
                                 <textarea class="form-control" id="diagnosis" cols="30" rows="5" disabled><?= $data->diagnosis ?></textarea>
                                 <label class="bmd-label-floating" id="label-ket">Keterangan</label>
                                 <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5"><?= $data->persiapan ?></textarea>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                  </form>
               <?php } ?>
               <a href="<?= base_url('listpelanggan'); ?>" class="btn btn-danger" role="button" title="Kembali"> <?php echo $this->lang->line('back'); ?> </a>
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
   const btnWA = document.getElementById('btn-wa');
   const status = document.getElementById('status')
   const labelDiag = document.getElementById('label-diag')
   const labelKet = document.getElementById('label-ket')
   const diagnosis = document.getElementById('diagnosis')
   const keterangan = document.getElementById('keterangan')

   if (status.value == 2) {
      labelKet.style.display = 'none'
      keterangan.style.display = 'none'
   }

   if (status.value == 3) {
      labelDiag.style.display = 'none'
      diagnosis.style.display = 'none'
   }

   status.addEventListener('change', () => {
      if (status.value == 6) {
         btnWA.innerText = 'Simpan'
         labelDiag.style.display = 'none'
         diagnosis.style.display = 'none'
         labelKet.style.display = 'none'
         keterangan.style.display = 'none'
      } else if (status.value == 2) {
         btnWA.innerText = 'Kirim WA'
         labelDiag.style.display = 'block'
         diagnosis.style.display = 'block'
         labelKet.style.display = 'none'
         keterangan.style.display = 'none'
      } else if (status.value == 3) {
         btnWA.innerText = 'Simpan'
         labelDiag.style.display = 'none'
         diagnosis.style.display = 'none'

         labelKet.style.display = 'block'
         keterangan.style.display = 'block'
      }

   })
</script>
<!-- End Function Javascript -->