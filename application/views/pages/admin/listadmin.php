<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Data Admin</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Data Admin</li>
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
                     <h6 class="m-0 font-weight-bold text-primary"> <a class="text-info" style="text-decoration: none;" class="collapse-item" href="<?php echo base_url() ?>tambahdataadmin"> <i class="fas fa-fw fa-plus text-info"></i> <?php echo $this->lang->line('add'); ?> Data Admin</h6></a>
                     <br>
                     <div class="table-responsive">
                        <table style="border-collapse: 1;color: #858796;border-bottom: 2px solid #e3e6f0;" class="table tablelist table-bordered table-striped" width="100%" height="1px" cellspacing="0">
                           <thead>
                              <tr height="20px">
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Nama Admin</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Telepon</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Jenis Kelamin</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">Alamat</th>
                                 <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('pengaturan'); ?></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $no = 1;
                              foreach ($read as $data) {
                              ?>
                                 <tr id="admin<?= $data->id_admin ?>">
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="5%"><?php echo $no ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->nama ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->jeniskelamin ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->telepon ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->alamat ?></td>
                                    <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%">
                                       <a style="margin-bottom: 10px; width:80px" href="<?= base_url('editdataadmin/' . str_replace(array('=', '+', '/'), '', $this->encrypt->encode($data->id_admin))); ?>" class="btn btn-sm btn-success" role="button" title="Ubah"><i class="fas fa-fw fa-pencil-alt"></i> <?php echo $this->lang->line('change'); ?> </a>
                                       <a style="margin-bottom: 10px; width:80px" href="#" data-toggle="modal" data-target="#deleteModal" data-id="<?= str_replace(array('=', '+', '/'), '', $this->encrypt->encode($data->id_admin)) ?>" class="btn btn-sm btnOpenDeleteModal btn-danger mr-1" title="Hapus" onclick="openDeleteModal(this, 'admin/deleteadmin')" class="btn btn-sm btn-danger" role="button" title="Hapus"> <i class="fas fa-fw fa-trash"></i> <?php echo $this->lang->line('delete'); ?> </a>
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

<!-- End Function Javascript -->