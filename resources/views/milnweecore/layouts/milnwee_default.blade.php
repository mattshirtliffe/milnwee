<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">

	<title>@yield('title')</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php
				if (isset($breadcrumbs)) {
					echo $breadcrumbs->render();
				}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				@yield('content')
			</div>
		</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
