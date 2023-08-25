<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
   $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/dist/js/pages/dashboard.js') ?>"></script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Lightbox -->
<script src="<?= base_url('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') ?>"></script>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      const bullets = document.querySelectorAll(".bullet");

      // Jumlah langkah yang ingin ditampilkan pada progress bar
      const totalSteps = 5;

      // Indeks langkah saat ini (dimulai dari 0)
      let currentStep = 0;

      // Fungsi untuk mengupdate tampilan bullets berdasarkan langkah saat ini
      function updateBullets() {
         bullets.forEach((bullet, index) => {
            if (index < currentStep) {
               bullet.style.backgroundColor = "green"; // bullet telah selesai
            } else {
               bullet.style.backgroundColor = "lightgray"; // bullet belum selesai
            }
         });
      }

      // Fungsi untuk mengatur langkah selanjutnya
      function nextStep() {
         if (currentStep < totalSteps) {
            currentStep++;
            updateBullets();
         }
      }

      // Fungsi untuk mengatur langkah sebelumnya
      function prevStep() {
         if (currentStep > 0) {
            currentStep--;
            updateBullets();
         }
      }

      // Tambahkan event listener untuk tombol "Next" dan "Prev" jika ada
      // Contoh: tombol "Next" dengan ID "nextBtn", tombol "Prev" dengan ID "prevBtn"
      const nextBtn = document.getElementById("nextBtn");
      if (nextBtn) {
         nextBtn.addEventListener("click", nextStep);
      }

      const prevBtn = document.getElementById("prevBtn");
      if (prevBtn) {
         prevBtn.addEventListener("click", prevStep);
      }

      // Update tampilan bullets awal ketika halaman dimuat
      updateBullets();
   });
</script>
<script>
   $(function() {
      // Summernote
      $('#summernote').summernote()

   })
   $(function() {
      $('.select2').select2()
   })
</script>
<script>

</script>
<script>
   $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
         event.preventDefault();
         $(this).ekkoLightbox({
            alwaysShowClose: true
         });
      });
   })
</script>
<script>
   $(function() {
      // Summernote
      $('.tablelist').DataTable({});
   })
</script>
<script>
   //   $(function() {
   //       //Initialize Select2 Elements
   //       $('.select2').select2()

   //       //Initialize Select2 Elements
   //       $('.select2bs4').select2({
   //          theme: 'bootstrap4'
   //       })
   //   })
   // 
</script>
<script>
   <?php if ($this->session->flashdata('success')) { ?>
      var isi = <?php echo json_encode($this->session->flashdata('success')) ?>

      Swal.fire({
         icon: 'success',
         title: 'Berhasil',
         text: isi
      })
   <?php } ?>
   <?php if ($this->session->flashdata('error')) { ?>
      var isi = <?php echo json_encode($this->session->flashdata('error')) ?>

      Swal.fire({
         icon: 'error',
         title: 'Gagal',
         text: isi
      })
   <?php } ?>
   <?php if ($this->session->flashdata('warning')) { ?>
      var isi = <?php echo json_encode($this->session->flashdata('warning')) ?>

      Swal.fire({
         icon: 'warning',
         title: 'Peringatan',
         text: isi
      })
   <?php } ?>
   <?php if ($this->session->flashdata('warningimport')) { ?>
      var isi = <?php echo json_encode($this->session->flashdata('warningimport')) ?>

      Swal.fire({
         icon: 'warning',
         title: '<h5 style:"margin-bottom:0px;padding-bottom:0px">Silahkan cek kembali field sku produk berdasarkan data di bawah :</h5>',
         text: isi
      })
   <?php } ?>
</script>

<script>
   function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
   }

   function converttanggalIndo(string) {
      bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

      tanggal = string.split("-")[2];
      bulan = string.split("-")[1];
      tahun = string.split("-")[0];

      return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
   }
</script>

</body>

</html>