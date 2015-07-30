<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<title>Admin</title>
</head>
<body>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6">
				@include('milnwee_core.admin.elements.admin_menu')
			</div>
			<div class="col-xs-6">
				@yield('content')
			</div>
		</div>
	</div>
	
	
</body>
</html>
