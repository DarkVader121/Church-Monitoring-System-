<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Church Monitoring System') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->

    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/red.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/DataTables-1.10.18/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" >

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div id="app">

        @include ('layouts.header')
         @if (optional(auth()->user())->isAdmin())
             @include ('layouts.nav')
         @elseif (optional(auth()->user())->isParish())
             @include ('priest-parish-dashboard.sidebar.nav') 
        @elseif (optional(auth()->user())->isCommissionHead())
             @include ('commission-head-dashboard.sidebar.nav') 
        @elseif (optional(auth()->user())->isPpc())
             @include ('ppc-dashboard.sidebar.nav') 
        @elseif (optional(auth()->user())->isPfc())
             @include ('pfc-dashboard.sidebar.nav') 
         @elseif (optional(auth()->user())->isPfcAdmin())
             @include ('pfc-chairman-dashboard.sidebar.nav') 
         @endif

        <main class="py-4 ">
            @yield('content')
        </main>
    </div>


   <script src="{{ asset('/js/app.min.js') }}"></script> 
    <script src="{{ asset('/js/apple.min.js') }}"></script> 
    <script src="{{ asset('/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ asset('/js/select2.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-select.min.js') }}"></script>


        <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/DataTables-1.10.18/js/dataTables.bootstrap.min.js') }}"></script>

    @stack ('scripts')

</body>
</html>
