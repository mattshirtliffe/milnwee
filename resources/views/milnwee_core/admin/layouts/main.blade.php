<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<title>Admin</title>
</head>
<body>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-2">
				@include('milnwee_core.admin.elements.admin_menu')
			</div>
			<div class="col-xs-8">
				@yield('content')
			</div>
		</div>
	</div>
	
	
</body>
</html>
