<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/assets/imgs/theme/favicon.svg')}}">
    <!-- Template CSS -->
    <link href="{{asset('backend/assets/css/main.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap">    <!-- Datatable CSS -->
    <link href="{{asset('backend/assets/vendor/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/vendor/datatable-button/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/vendor/datatable-responsive/css/responsive.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>'
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.1/tinymce.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('css')
</head>
