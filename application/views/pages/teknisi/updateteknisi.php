<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">

         <?= $this->session->flashdata('message'); ?>
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1><?php echo $this->lang->line('add'); ?> Data Teknisi</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Teknisi</li>
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

               <form action="<?php echo base_url() . 'teknisi/updateteknisi'; ?> " enctype="multipart/form-data" method="post" accept-charset="utf-8" aria-hidden="true">
                  <?php foreach ($teknisi as $datateknisi) ?>
                  <h5>Data Teknisi</h5>
                  <hr>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Nama Teknisi<small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;" type="text" required name="namateknisi" class="form-control" value="<?= $datateknisi->nama ?>">
                           <input style="padding-bottom: 10px;max-width: 300px; margin-left: 70px;" type="hidden" value="<?= str_replace(array('=', '+', '/'), '', $this->encrypt->encode($datateknisi->id_teknisi)) ?>" name="idteknisi" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Telepon <small class="text-danger">*</small></label>
                           <input style="padding-bottom: 10px;" type="number" required name="telepon" class="form-control" value="<?= $datateknisi->telepon ?>">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">Jenis Kelamin<small class="text-danger">*</small></label>
                           <select name="jeniskelamin" class="form-control">
                              <?php if ($datateknisi->jeniskelamin == "Laki-Laki") { ?>
                                 <option value="<?= $datateknisi->jeniskelamin ?>"><?= $datateknisi->jeniskelamin ?></option>
                                 <option value="Perempuan">Perempuan</option>
                              <?php } elseif ($datateknisi->jeniskelamin == "Perempuan") { ?>
                                 <option value="<?= $datateknisi->jeniskelamin ?>"><?= $datateknisi->jeniskelamin ?></option>
                                 <option value="Laki-Laki">Laki-Laki</option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">

                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="bmd-label-floating">Alamat<small class="text-danger">*</small></label>
                           <textarea name="alamat" class="form-control" required cols="30" rows="5"><?= $datateknisi->alamat ?></textarea>
                        </div>
                     </div>
                  </div>
                  <button type="submit" id="btnsaveteknisi" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                  <a href="<?= base_url('listteknisi'); ?>" class="btn btn-danger" role="button" title="Kembali"> <?php echo $this->lang->line('back'); ?> </a>

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