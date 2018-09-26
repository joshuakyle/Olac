<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OLAC|Web site') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com"><!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->

    <!-- Styles -->
<!--     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
 -->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>OLAC|Website</title>

    <style type="text/css">
        .nav-wrapper{
            background-color: #0a11ad;
            height: 100px!important;
        }
        .brand-logo{
            margin-left: 12px;
            z-index: 1;
        }
        .logo{
            width: 200px;
            height: 150px;
        }
        li>a{
            position: relative;
            top: 10px;
            font-size: 1.3em!important;
        }
        .bgimg{
           background-repeat: no-repeat;
           background-size: cover;
           background-position: center;
           background-image: url('{{asset('img/Tanauan_Building.jpg')}}');
           width: 100%;
           height: 600px;

        }
        .bgop{
            width: 100%;
            height: 565px;
            position: absolute;
            top: 100px;
            z-index: 0;
            opacity: .5;
            background-color: black;
        }
        .about{
            width: 100%;
            height: 100vh;
        }
        .camp{
            z-index: 10;
            color: white;
            text-align: center;
            top: -80vh;
            position: relative;
        }
        .footer{
            width: 100%;
            height: 70vh;
            background-color: #1827b6;
            color: white;
        }
        .flogo{
            width: 200px;
            height: 150px;   
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-wrapper" style="border-bottom: 3px solid white">
          <a href="#" class="brand-logo center"><img class="circle logo" src="{{asset('img/olac-logo.jpg')}}"></a>
          <ul class="right hide-on-med-and-down">
            @if($school->status == 1)
            <li><a href="{{ route('enroll')}}">Enroll now!</a></li>
            @endif
            <li><a href="{{ route('studentLogin')}}">Check you Grade!</a></li>
            <li><a href="{{ url('/login')}}">Teacher Login</a></li>
        </ul>
    </div>
</nav>
<div class="body">
    <div id="Home">
        <div class="bgop"></div>
        <div class="bgimg" style="background-image: {{asset('img/Tanauan_Building.jpg')}};"></div>
        <div class="camp">    
            <h1 class="">Tanauan Campus</h1>
        </div>
    </div>
    <div class=""></div>
    <div class="about">
        <div class="row">
            <div class="col s12 center">
                <h1 style="font-family: helvetical;">ABOUT OLAC</h1>
            </div>
            <div class="col s8 offset-s2 center">
                <p style="text-align: justify;font-size: 1.3em;">
                    The institution which was known before as Our Lady of Assumption School’s coming to existence was conceptualize in 1988 and was made possible in 1989 by Dr. Maximo C. Acierto Jr and Dr. Ethelwyn A. Acierto, both doctors of education, in the pursuit of their dream of providing Christian education to the young men and women of San Pedro, Laguna and to cater to the growing needs in the Education sector of a fast-growing population in the Southern Tagalog region.
                </p>
                <p style="text-align: justify;font-size: 1.3em;">    
                    As the demand for quality education arises in the southern part of the Region, a fifth campus was opened in 2009 in the heart of the City of
                    Tanauan, Batangas, which is located at N. Gonzales St. close to the busy main roads of the city.
                </p>
                <p style="text-align: justify;font-size: 1.3em;">
                    Our Lady of Assumption College pursues the Christian values to lead its student to see God in all things, to strive for the greater glory of
                    God, It aims to form productive citizen rooted in their own culture and within the global culture imbued with scientific spirit and values of
                    professionalism and strongly committed to a faith.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="row">
        <div class="col s4 justify center" style="padding-top: 20vh;">
            <h5>Our Lady of Assumption College</h5>
            <p>
            Our Lady of Assumption College of Laguna Inc is a private and non-sectarian school south of Metro Manila established in 1989. Our Lady of Assumption College is recognized by the Department of Education and the Commission on Higher Education.
            </p>
        </div>
        <div class="col s4 center" style="padding-top: 20vh;">
            <img class="circle flogo" src="{{asset('img/olac-logo.jpg')}}">
            
        </div>
        <div class="col s4 justify" style="padding-top: 20vh;">
            <h5>Address</h5>
            <p><i class="small material-icons">home</i> N. Gonzales St. Tanauan City Batangas</p>
            <h5>Contact</h5>
            <p><i class="small material-icons">phone</i>(043) 406 7160</p>
        </div>
        <div class="col s12 center"><p>©Our Lady of Assumption College Batangas Branch 2018</p></div>
    </div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</html>