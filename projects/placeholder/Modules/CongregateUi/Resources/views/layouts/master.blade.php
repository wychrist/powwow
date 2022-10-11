<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module CongregateUi</title>

        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/congregateui.css') }}"> --}}

    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/congregateui.js') }}"></script> --}}
    </body>
</html>
