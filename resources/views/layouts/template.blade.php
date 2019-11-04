<!DOCTYPE html> 
<html lang="en-us">
 
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LinkedINNYC | @yield('title')</title>


	<link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">

	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
	
    <!-- App css -->
    @stack('css')

</head>

<body style="
    background: #eae7e7;
">

	<div id="wrapper">

		@include('layouts.menu')

		<div>
			 @yield('content')
		</div>

	</div>

<!-- Mainly scripts -->
 <script src="{{ url('assets/js/jquery.min.js') }}"></script>
 <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

<!-- App scripts -->
@stack('scripts')




</body>

</html>