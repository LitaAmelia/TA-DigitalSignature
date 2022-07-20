<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ $title }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('') }}assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('') }}assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->

  <link rel="stylesheet" href="{{ asset('') }}assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">

  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('') }}assets/css/vertical-layout-light/style.css">
  <!-- endinject -->

  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

  <link rel="shortcut icon" href="{{ asset('') }}assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    @include('dashboard.layouts.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial -->
      @include('dashboard.layouts.sidebar')
      <!-- partial -->
      <div class="main-panel mb-5">
          <div class="content-wrapper">
        @yield('content')
        <!-- content-wrapper ends -->
          </div>
        {{-- @include('dashboard.layouts.footer')  --}}
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include('sweetalert::alert')
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

  <!-- plugins:js -->
  <script src="{{ asset('') }}assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->

  <script src="{{ asset('') }}assets/myjs.js"></script>
  
  <!-- Plugin js for this page -->
  <script src="{{ asset('') }}assets/vendors/chart.js/Chart.min.js"></script>
  <script src="{{ asset('') }}assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{ asset('') }}assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="{{ asset('') }}assets/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('') }}assets/js/off-canvas.js"></script>
  <script src="{{ asset('') }}assets/js/hoverable-collapse.js"></script>
  <script src="{{ asset('') }}assets/js/template.js"></script>
  <script src="{{ asset('') }}assets/js/settings.js"></script>
  <script src="{{ asset('') }}assets/js/todolist.js"></script>
  <script src="{{ asset('') }}assets/js/file-upload.js"></script>
  <script src="{{ asset('') }}assets/js/typeahead.js"></script>
  <script src="{{ asset('') }}assets/js/select2.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('') }}assets/js/dashboard.js"></script>
  <script src="{{ asset('') }}assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="{{ asset('') }}assets/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->

  @yield('myscript')
</body>

</html>

<script>
  $('.kategori-delete-confirm').on('click', function (event) {
    var form = $(this).closest('form');
    var name = $(this).data('name');
     event.preventDefault();
     swal({
         title: 'Apakah kamu yakin?',
         text: `Kategori ${name} akan terhapus secara permanen!`,
         icon: 'warning',
        //  buttons: ["Cancel", "Yes!"],
        buttons: ["Kembali", "Ya"],
        dangerMode: true,
         }).then((willDelete) => {
            if(willDelete) {
              form.submit();
            }
          });
    });

    $('.dokumen-delete-confirm').on('click', function (event) {
    var form = $(this).closest('form');
    var name = $(this).data('name');
     event.preventDefault();
     swal({
         title: 'Apakah kamu yakin?',
         text: `File ${name} akan terhapus secara permanen!`,
         icon: 'warning',
        //  buttons: ["Cancel", "Yes!"],
        buttons: ["Kembali", "Ya"],
        dangerMode: true,
         }).then((willDelete) => {
            if(willDelete) {
              form.submit();
            }
          });
    });

    $('.qrcode-delete-confirm').on('click', function (event) {
    var form = $(this).closest('form');
    var name = $(this).data('name');
     event.preventDefault();
     swal({
         title: 'Apakah kamu yakin?',
         text: 'Data akan terhapus secara permanen!',
         icon: 'warning',
        //  buttons: ["Cancel", "Yes!"],
        buttons: ["Kembali", "Ya"],
        dangerMode: true,
         }).then((willDelete) => {
            if(willDelete) {
              form.submit();
            }
          });
    });

    $('.show-alert-nonaktif-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Apakah kamu yakin akan menonaktifkan akun ${name}?`,
            icon: "warning",
            type: "warning",
            buttons: ["Kembali","Ya!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });

    $('.show-alert-aktif-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Apakah kamu yakin akan mengaktifkan akun ${name}?`,
            // icon: "warning",
            // type: "warning",
            buttons: ["Kembali","Ya!"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
