<footer class="main-footer">
   <strong>Copyright &copy; 2023 <a href="<?= base_url('dashboard') ?>">ServiceCenter</a>.</strong>
   All rights reserved.
   <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
   </div>
</footer>

<!-- List Form Modal -->

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('confirmlogout'); ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body"><?php echo $this->lang->line('messagelogout'); ?></div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            <a class="btn btn-info" href="<?= base_url('auth/logout') ?>"><?php echo $this->lang->line('logout'); ?></a>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="logoutLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="logoutLabel"><?php echo $this->lang->line('headconfirmdelete'); ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body"><?php echo $this->lang->line('confirmdelete'); ?></div>
         <div class="modal-footer">
            <?= form_open('', 'class="d-inline" id="formLinkDelete"') ?>
            <input type="hidden" name="id" id="valueId">
            <button type="submit" class="btn btn-danger"> <?php echo $this->lang->line('yes'); ?> </button> <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('no'); ?></button>
            <?= form_close(); ?>
         </div>
      </div>
   </div>
</div>
<div id="modaltipeproduk" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <center>
               <h3 class="modal-title">Pilih Tipe Produk</h3>
            </center>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table class="table tablelist table-hover" id="tabletipeproduk" width="100%" height="1px" cellspacing="0">
                  <thead>
                     <tr height="20px">
                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('number'); ?></th>
                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;">MasterID</th>
                        <th style=" padding: 0.75rem;vertical-align: top;border-top: 1px solid #e3e6f0;"><?php echo $this->lang->line('description'); ?></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1;
                     foreach ($tipeproduk as $data) {
                     ?>
                        <tr id="tipeproduk" data-id="<?= $data->masterid; ?>" data-tipeproduk="<?= $data->mastername; ?>" onclick="tipeprodukmodal()">

                           <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="5%"><?php echo $no ?></td>
                           <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->mastercode ?></td>
                           <td style="vertical-align: top;border-top: 1px solid #e3e6f0;" width="20%"><?php echo $data->mastername ?></td>
                        </tr>
                     <?php
                        $no++;
                     }
                     ?>
                  </tbody>
               </table>
            </div>

         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
         </div>
      </div>
   </div>
</div>

<!-- End List Form Modal -->
</div>
<!-- ./wrapper -->