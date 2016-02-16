
<?php if ($method == 'POST') : ?>
	<form action="{{$action}}" method='POST'>
<?php else: ?>
	<form action="{{$action}}" method='POST'>
	<input name="_method" type="hidden" value="{{$method}}">
<?php endif; ?>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
