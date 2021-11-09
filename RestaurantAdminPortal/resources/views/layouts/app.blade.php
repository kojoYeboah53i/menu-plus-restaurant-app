<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{{ asset('image/Menuplus_logo.png') }}"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="booking-url" content="{{ route('dashboard.bookings.selectedBooking') }}">
        <title>Menu Plus | @yield('title')</title>
        <script src="{{asset('js/app.js')}}"></script>
    </head>
    <body class="font-helRegular">
      
    
            <style>


            </style>
        </div>
        @yield('main')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" defer></script>
        <script src="{{asset('js/sidebar.js')}}"></script>
        <link href="{{ asset('css/media.css') }}" rel="stylesheet">


        <script>



      </script>
    </body>
</html>
