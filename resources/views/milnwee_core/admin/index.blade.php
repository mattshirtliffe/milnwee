@extends('milnwee_core.admin.layouts.main')
@section('content')
	<h1>{{ $page_data['model_class_plural'] }}</h1>
	
	<hr>
	<a href="" class="btn btn-primary">Add new {{ $page_data['model_class_singular'] }}</a>
	<hr>
	
	<table>
		<thead></thead>
	</table>
	
@endsection
