<?php if (!empty($service)) : ?>
   <?php foreach ($service as $data)  ?>
   <table align="center" style="font-size: 20px;margin-bottom: 40px;margin-top:-30px">
      <tr>
         <td>Nama Pelanggan </td>
         <td>:</td>
         <td><?= $data->namapelanggan ?></td>
      </tr>
      <tr>
         <td>Merk Laptop </td>
         <td>:</td>
         <td><?= $data->merklaptop ?></td>
      </tr>
   </table>
   <ul class="step-wizard-list">
      <li class="step-wizard-item <?php if ($data->status == 1) {
                                       echo "current-item";
                                    } ?>">
         <span class="progress-count">1</span>
         <span class="progress-label">Unit Masuk</span>
      </li>
      <li class="step-wizard-item  <?php if ($data->status == 2) {
                                       echo "current-item";
                                    } ?>">
         <span class="progress-count">2</span>
         <span class="progress-label">Diagnosis</span>
      </li>
      <li class="step-wizard-item  <?php if ($data->status == 3) {
                                       echo "current-item";
                                    } ?>">
         <span class="progress-count">3</span>
         <span class="progress-label">Persiapan</span>
      </li>
      <li class="step-wizard-item  <?php if ($data->status == 4) {
                                       echo "current-item";
                                    } ?>">
         <span class="progress-count">4</span>
         <span class="progress-label">Pengerjaan</span>
      </li>
      <li class="step-wizard-item  <?php if ($data->status == 5) {
                                       echo "current-item";
                                    } ?>">
         <span class="progress-count">5</span>
         <span class="progress-label">Selesai</span>
      </li>


      <!-- <?php if ($data->status_unitmasuk == 1) { ?>

   <?php } ?>
   <?php if ($data->status_diagnosis == 1) { ?>

   <?php } ?>
   <?php if ($data->status_persiapan == 1) { ?>

   <?php } ?>
   <?php if ($data->status_pengerjaan == 1) { ?>

   <?php } ?>
   <?php if ($data->status_selesai == 1) { ?>

   <?php } ?> -->
   </ul>
<?php else : ?>
   <div class="text-center">
      <img width="280" src="<?= base_url('assets/img/data_not_found.png') ?>" alt="">
   </div>
<?php endif; ?>