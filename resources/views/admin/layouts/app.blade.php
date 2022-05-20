<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <!-- General CSS Files -->
      <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}">
      <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">

      <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
      <!-- Template CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
      <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

      <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
      <!-- Custom style CSS -->
      <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
      <link rel='shortcut icon' type='image/x-icon' href="{{asset('assets/img/coffee.png')}}" />
      <style>
        .toast-success {
            color: #008000;
            background-color: #60d80a;
            border-color: #008000;
        }

        /* warning toast class: */
        .toast-warning {
            color: #8a6d3b;
            background-color: #fff8c4;
            border-color: #f2c779;
        }

        /* error toast class: */
        .toast-error {
            color: #f94142;
            background-color: #a82f2f;
            border-color: #f94142;
        }
    </style>
  @yield('extra_css')
</head>
<body>
    <!-- <div class="loader"></div> -->
  <div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('admin.include.navbar')

        @include('admin.include.sidebar')
      <!-- Main Content -->
        <div class="main-content">
              @yield('content')
        </div>  
      </div>

      @include('admin.include.footer')
    </div>
  </div>



  <script src="{{asset('assets/js/scripts.js')}}"></script>
     <!-- General JS Scripts -->
  <script src="{{asset('assets/js/app.min.js')}}"></script>
  <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
  <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{asset('assets/bundles/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{asset('assets/js/page/datatables.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('assets/js/page/index.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{asset('assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{asset('assets/js/custom.js')}}"></script>
  <script src="{{asset('js/toastr.min.js')}}"></script>
  <script src="{{asset('js/toast.js')}}"></script>

  @yield('extra_js')
</body>
</html>