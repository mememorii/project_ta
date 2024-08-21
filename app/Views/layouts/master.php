<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title?></title>

  <link rel="icon" type="image/x-icon" href="<?= base_url()?>public/assets/dist/img/83790f2b43f00be.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <script src="https://kit.fontawesome.com/86e5d56058.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/select2/css/select2.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/dist/css/color.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/dropzone/min/dropzone.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>public/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
  <script src="<?= base_url()?>public/assets/plugins/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/select2/js/select2.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .btn-primary {
        color: #fff;
        background-color: #7bb3ff !important;
        border-color: #007bff;
        box-shadow: none;
    }
    @media (max-width: 767px) {
    .phone {
      display: flex; /* Ubah elemen row menjadi flex container */
      flex-direction: column; /* Atur arah flex menjadi kolom *//* Sembunyikan breadcrumb pada layar ukuran smartphone */
    }
    .phone > * {
        flex: 1 1 100%; /* Setiap anak elemen di dalam row mengambil 100% lebar */
        max-width: 100%; /* Pastikan lebar maksimum 100% */
    }
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?= $this-> include('layouts/navbar')?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?= $this-> include('layouts/sidebar')?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?= $this-> include('layouts/breadcrumb')?>
      <!-- /.content-header -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <?= $this-> renderSection('content')?>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
      <!-- /.content-wrapper -->
        <?= $this->include('layouts/footer')?>
      <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url()?>public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- ChartJS -->
  <script src="<?= base_url()?>public/assets/plugins/chart.js/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url()?>public/assets/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url()?>public/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url()?>public/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url()?>public/assets/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url()?>public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url()?>public/assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url()?>public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url()?>public/assets/dist/js/adminlte.js"></script>

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url()?>public/assets/dist/js/pages/dashboard.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src=".<?= base_url()?>public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url()?>public/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="<?= base_url()?>public/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- BS-Stepper -->
  <script src="<?= base_url()?>public/assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <!-- dropzonejs -->
  <script src="<?= base_url()?>public/assets/plugins/dropzone/min/dropzone.min.js"></script>
  <script>
    $(document).ready(function() {
      // Initialize DataTables with your preferred settings
      $('#example1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "columnDefs": [
              { "targets": [1], "orderData": [1] } // Use data-order attribute for sorting the second column (Class)
          ]
      });

      $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "columnDefs": [
              { "targets": [1], "orderData": [1] } // Use data-order attribute for sorting the second column (Class)
          ]
      });

      // Redraw the table when the tab is shown
      $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
          $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
      });
    });
  </script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date picker
      $('#reservationdate').datetimepicker({
          format: 'L'
      });

      //Date and time picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      })

      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })

    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
  </script>
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
      const konfirmasiButtons = document.querySelectorAll('.konfirmasi');

      konfirmasiButtons.forEach(button => {
          button.addEventListener('click', function(event) {
              event.preventDefault(); 

              const href = this.getAttribute('href');

              Swal.fire({
                  title: 'Apakah anda yakin?',
                  text: "Data Tidak Akan Bisa Dikembalikan",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#28a745',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Tidak',
                  confirmButtonText: 'Iya'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = href; 
                  }
              });
          });
      });
  });
</script>
</body>
</html>