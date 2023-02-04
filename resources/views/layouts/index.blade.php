<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Aplikasi Absensi & Payroll</title>
    <link href="{{ url('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <script src="{{ url('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-white text-gray-700">
    <div class="flex flex-row">
        <div class="w-40 sm:w-52 bg-[#F6F8FD] border-r-2 shadow-md min-h-screen flex-none">
            @include('layouts.sidebar')
        </div>
        <div class="flex-grow p-10 min-h-screen">
            @yield('content')
        </div>
    </div>
</body>

</html>
