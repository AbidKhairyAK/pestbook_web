<!DOCTYPE html>
<html>
<head>
	<title>Penyakit Tumbuhan | @yield('title')</title>
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- Datatables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"/>

	@yield('style')
	
	<style type="text/css">
		body {
			font-family: 'Cairo', sans-serif;
			background-color: #eaefea;
			color: #333;
		}
		.navbar b {
			font-weight: 600;
		}
		.nav-tabs .nav-link.active {
			background-color: #eee;
			border-color: transparent;
		}
	</style>
</head>
<body>

	<nav class="navbar navbar-expand-md bg-success navbar-dark shadow">
	  <a class="navbar-brand" href="{{ route('libraries.index') }}"><b>Penyakit Tumbuhan</b></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="collapsibleNavbar">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="{{ route('libraries.index') }}"><b>Library HPT</b></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="{{ route('consultations.index') }}"><b>Konsultasi</b></a>
	      </li>
	    </ul>
	  </div>  
	</nav>

	<div class="container mt-4">
		<div class="bg-light shadow-lg rounded p-3">
			<h1 class="mb-4"><b>@yield('title')</b></h1>

			@yield('content')

		</div>
	</div>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- Datatables -->
	<script src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/fontawesome.min.js"></script>
	@yield('script')
</body>
</html>