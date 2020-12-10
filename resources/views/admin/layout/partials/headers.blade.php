<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title> @yield('page_title') </title>

    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/custom.css') }}" rel="stylesheet">

</head>