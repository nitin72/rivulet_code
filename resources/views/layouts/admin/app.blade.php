<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title></title>

  @include('layouts.admin.common.styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.admin.common.header')
  @include('layouts.admin.common.sidebar') 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <br>
    <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.admin.common.footer')
  
</div>
<!-- ./wrapper -->
  @include('layouts.admin.common.scripts')
</body>
</html>
