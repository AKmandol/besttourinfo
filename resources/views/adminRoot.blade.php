<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BestTourInfo</title>

        <!-- favicon -->
        <link rel="icon" href="{{ url('img/fav.png') }}">
        <!-- favicon -->
        
        <style>
            body {
                font-family: 'Times New Roman', Times, serif;
            }
        </style>

        <script>
            (function(){
                window.laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();
        </script>
        
        <link href="./admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="./admin/css/sb-admin-2.css" rel="stylesheet">
        <link id="light-theme" href="./admin/css/light.css" rel="stylesheet" disabled>
        <link id="dark-theme" href="./admin/css/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="./css/app.css">
    </head>
    <body>

        <div id="app">

            @if(Auth::guard('admins')->check())
            <admin :user="{{Auth::guard('admins')->user()}}" ></admin>
            @else
            <admin :user="false"></admin>
            @endif

        </div>
                
        <!-- Admin Bootstrap core and JavaScript-->
        <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('/bootstrap/bootstrap.bundle.min.js')}}"></script> 
        <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <!-- End of Admin Bootstrap core and JavaScript -->

        <script src="{{asset('/js/app.js')}}"></script>
        <script src="{{asset('admin/js/sb-admin-2.js')}}"></script>
    </body>
</html>
