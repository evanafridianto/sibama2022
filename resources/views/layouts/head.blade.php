<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title . ' - ' . config('app.name', 'Sistem Informasi Banyu Malang') }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('sibama.ico') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('admin/vendor/jqvmap/css/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendor/alertifyjs/css/alertify.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/waitMe/waitMe.css') }}">

    <!-- Datatable -->
    <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/skin-2.css') }}">
</head>
