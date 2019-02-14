<html>
<head>
    <title> @yield('title') </title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Compiled and Minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <link rel="stylesheet" href="{!! asset('css/main.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/animate.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/font-awesome.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/responsive.css') !!}">

    <!--Import Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="{!! asset('js/jquery.js') !!}"></script>
    <script src="{!! asset('js/jquery.prettyPhoto.js') !!}"></script>
    <script src="{!! asset('js/wow.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.isotope.js') !!}"></script>
    <script src="{!! asset('js/main.js') !!}"></script>
    
</head>
<body class="grey lighten-3">
@include('Layout.navbar')
@yield('content')
@include('Layout.footer')

<!--Materialize JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>