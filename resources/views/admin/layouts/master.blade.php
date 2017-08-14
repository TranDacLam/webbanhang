<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Admin | @yield('title')</title>
    <base href="{{asset('')}}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link type="text/css" rel="stylesheet" href="source/assets/admin/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link type="text/css" rel="stylesheet" href="source/assets/admin/css/AdminLTE.min.css">
    <link type="text/css" rel="stylesheet" href="source/assets/admin/css/skins/_all-skins.min.css">
    <link rel="stylesheet" title="style" href="source/assets/dest/css/custom.css">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      @include('admin.layouts.header')
      @include('admin.layouts.menu')
      <div class="content-wrapper">
        <div class="flash_success">
          @include('layouts.error')
        </div>
        @yield('content')
      </div>
      @include('admin.layouts.footer')
      <div class="control-sidebar-bg"></div>
    </div>
    <script src="source/assets/admin/js/jquery-2.2.3.min.js"></script>
    <script src="source/assets/admin/js/bootstrap.min.js"></script>
    <script src="source/assets/admin/js/app.min.js"></script>
    <script src="source/assets/admin/js/demo.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="source/assets/admin/js/custom.js"></script>
    @include('layouts.flash')
  </body>
</html>
