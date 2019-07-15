<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Усадебное достояние | Административная часть</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="/assets/plugins/jquery-ui/jquery-ui.min.css?v=215077014154308be415e1181a14646f" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css?v=416bb9e03b223eba66e9a3ca5a9da02e" rel="stylesheet" />
    <link href="/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css?v=3e00fb24de19a111e70a8b8fe70c6782" rel="stylesheet" />
    <link href="/assets/plugins/animate/animate.min.css?v=53d7dfb5f5742dd7d052e4036dcc077d" rel="stylesheet" />
    <link href="/assets/css/default/style.min.css?v=b47d387cdd8ab7b1f5ccd9deeee1face" rel="stylesheet" />
    <link href="/assets/css/default/style-responsive.min.css?v=959bba567bb4e4c78cafb84655564895" rel="stylesheet" />
    <link href="/assets/css/default/theme/blue.css?v=c29787db3b5572e55075f3efaeafaa89" rel="stylesheet" id="theme" />
    <link href="/assets/css/default/custom.css?v=2b259ce4c40a09221341c3dbe6ce7237" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/plugins/pace/pace.min.js?v=ecae6d239a5cf2d07564ebea22fd9ee3"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top flat-black">
<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->

<div class="login-cover">
    <div class="login-cover-image" style="background-image: url(/images/desktop/back2x.jpg?v=2ab7009a15c88e9018d1e04efc330d41)" data-id="login-cover-image"></div>
    <div class="login-cover-bg"></div>
</div>
<!-- begin #page-container -->
@yield('content')
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/plugins/jquery/jquery-3.2.1.min.js?v=473957cfb255a781b42cb2af51d54a3b"></script>
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js?v=bcad1d60cf9cb3bb180a1a8339ed5529"></script>
<script src="/assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js?v=18a1ebc44d97e64b7461be8cdde9d766"></script>
<!--[if lt IE 9]>
<script src="/assets/crossbrowserjs/html5shiv.js"></script>
<script src="/assets/crossbrowserjs/respond.min.js"></script>
<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js?v=13672635828a7010898a49c71a99ffce"></script>
<script src="/assets/plugins/js-cookie/js.cookie.js?v=d8f7daaf3cdc73a04124791fd24adb67"></script>
<script src="/assets/js/theme/default.min.js?v=3e84b6ba7db2fec6a7837dadf0e39600"></script>
<script src="/assets/js/apps.min.js?v=7a8207ea3c4e9ba8b995a5d18f487897"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/js/demo/login-v2.demo.min.js?v=664d547c18625d1d38e86039f1c2a878"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
        LoginV2.init();
    });
</script>
</body>
</html>