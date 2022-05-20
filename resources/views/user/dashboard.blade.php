@extends('user.layouts.app')

@section('extra_css')
<title>Dashboard</title>
<link rel="stylesheet" href="{{ asset('assets/bundles/izitoast/css/iziToast.min.css') }}">

@stop

@section('content')
    <div class="row">
    	<h1>User Dashboard</h1>
        </div>

@stop

@section('extra_js')
    <!-- JS Libraies -->
  <script src="{{ asset('assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/toastr.js') }}"></script>
  <script src="{{ asset('assets/js/common.js') }}"></script>
@stop