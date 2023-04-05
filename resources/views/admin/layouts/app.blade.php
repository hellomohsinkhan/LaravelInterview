<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('backend/images/logo.png') }}" type="image/vnd.microsoft.icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>{{ config('app.name', 'UTSAV - India a Land of Festivals | A Ministry of Tourism Initiative') }}</title>
     <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/material.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/css/style2.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/datatable/css/buttons.dataTables.min.css') }}" />
    <link href="{{ asset('backend/dist/css/adminlte.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    
    <script src="{{ asset('backend/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
     <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script>
    $(document).ready(function() {

        $( document ).ajaxStart(function() {
           $('#whole_page_loader').show();
        }); 
        $(document).ajaxError(function() {
           $('#whole_page_loader').hide();
           //alert("Something went wrong!");
        });
        $(document).ajaxSuccess(function() {
           $('#whole_page_loader').hide();
        });		
      
    });
    </script>
    @stack('style')
</head>
<style>
.whole-page-overlay{
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  position: fixed;
  background: rgba(0,0,0,0.6);
  width: 100%;
  height: 100% !important;
  z-index: 1050;
  display: none;
}
.whole-page-overlay .center-loader{
  top: 50%;
  left: 52%;
  position: absolute;
  color: white;
}
</style>
<body class="dashbordbg">
    <div class="container-fluid">
        <div class="row">
		<div class="whole-page-overlay" id="whole_page_loader">
         <img class="center-loader"  style="height:100px;" src="{{ asset('backend/images/reload.svg') }}"/>
		 </div>
            <div class="midarea">
                <div class="row m-0">
                    @include('admin.layouts.sidebar')
                    <div class="col-12 col-sm-10 col-md-10 p-0">
                        @include('admin.layouts.header')
                        <div class="col-12 col-md-12 col-sm-12 banner">
                            <div class="row">
                                <img src="{{ asset('backend/images/banner.jpeg') }}" alt="Banner"
                                    class="img-fluid" />
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
@include('admin.layouts.footer')
<script src="{{ asset('backend/js/sweetalert.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/backend/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/backend/datatable/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('/backend/datatable/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ asset('/backend/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('/backend/datatable/js/responsive.bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/datatable/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('/backend/datatable/js/jszip.min.js')}}"></script>
<script src="{{ asset('/backend/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('/backend/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('/backend/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('/backend/datatable/js/buttons.print.min.js')}}"></script>
<script type="text/javascript">
  $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            // startDate: '-3d'
        });



</script>