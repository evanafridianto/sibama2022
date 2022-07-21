<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title . ' - ' . config('app.name', 'Sistem Informasi Banyu Malang') }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('sibama.ico') }}">
    <script src="{{ asset('admin/vendor/jquery/jquery-3.6.0.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin/vendor/jqvmap/css/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendor/alertifyjs/css/alertify.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/waitMe/waitMe.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/leaflet/leaflet-panel-layers/leaflet-panel-layers.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendor/select2/css/select2.min.css') }}">
    <link href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">


    <!-- Datatable -->
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/skin-2.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
</head>
