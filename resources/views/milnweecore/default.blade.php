@extends('milnweecore.layouts.milnwee_default')

@section('content')

	<h1>welcome to the cms</h1>

	<ul class="list-group">
		<?php foreach ($controllers as $controllerName => $controllerIndexRoute) : ?>
			<a class="list-group-item" href="{{route($controllerIndexRoute)}}">{{str_plural($controllerName)}}</a>
		<?php endforeach; ?>
	</ul>

@endsection
