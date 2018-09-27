<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/olac-small.png') }}" />
    <title>OLAC|School System</title>


    

    <!-- Fonts -->
    <link href="{{ asset('css/material-icons.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/enroll.css') }}" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/materializecss.css') }}">


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="@yield('bgcolor')">
    <div id="app">
        @yield('content')
    </div>
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<!-- Scripts -->
<script type="text/javascript">
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false, // Close upon selecting a date,
    });
    $('select').material_select();
    
    //initialize all modals           
    $('.modal').modal();
    //or by click on trigger
    $('.modal-trigger').modal();
</script>
@yield('customjs')
</html>
