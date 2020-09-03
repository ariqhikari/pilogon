<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="shortcut icon" href="{{ asset("resource/image/logo 1.png") }}" type="image/x-icon">
<!--===============================================================================================-->
<link rel="stylesheet" href="{{ asset("assets/vendor/bootstrap/css/bootstrap.min.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("form/fonts/font-awesome-4.7.0/css/font-awesome.min.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("form/vendor/animate/animate.css") }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset("form/vendor/css-hamburgers/hamburgers.min.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("form/vendor/select2/select2.min.css") }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("form/css/util.css") }}">
	<link rel="stylesheet" type="text/css" href="{{ asset("form/css/main.css") }}">
	@stack('addon-style')
</head>
<body>

@yield('content')

<script src="{{ asset("assets/vendor/jquery/jquery.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{ asset("assets/vendor/bootstrap/js/bootstrap.min.js") }}"></script>
<!--===============================================================================================-->
<script src="{{ asset("form/vendor/select2/select2.min.js") }}"></script>
<!--===============================================================================================-->
<script src="{{ asset("form/vendor/tilt/tilt.jquery.min.js") }}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{ asset("form/js/main.js") }}"></script>
</body>
</html>