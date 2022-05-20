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
      <!-- Main Content -->
        <div class="main-content">
    <div class="row ml-5 mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="admin_login" >
                  @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="#" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>
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
  <script>



    $(function() {

        $('#admin_login').submit(function(e){

            e.preventDefault();
            var fd = new FormData(this);
            fd.append('_token',"{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('admin.login_submit') }}",
                type: "post",
                data: fd,
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('.generalsets').prop('disabled', true);
                },
                success: function (result) {

                    if(result.status===true){
                        toastr.success(result.msg, "Message", {
                            timeOut: 2000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            tapToDismiss: 0
                        })
                        window.location.href = "{{route('admin.dashboard')}}";

                    }
                    else{
                        toastr.error("Credentials Does Not Match", "Message", {
                            timeOut: 2000,
                            closeButton: !0,
                            progressBar: !0,
                            onclick: null,
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            tapToDismiss: 0
                        })
                    }
                }
            })
        });
    });


</script>
</body>
</html>