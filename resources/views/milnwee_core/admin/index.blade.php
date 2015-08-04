@extends('milnwee_core.admin.layouts.main')
@section('content')
	<h1>{{ $model_data['model_class_plural'] }}</h1>
	
	<hr>
	<a href="{{ route($model_data['model_url_slug'] . '.add') }}" class="btn btn-primary">Add new {{ $model_data['model_class_singular'] }}</a>
	<hr>
	
	<table>
		<thead>
			<tr>
				@foreach ($index_columns as $col)
					<td><strong>{{ucwords($col)}}</strong></td>
				@endforeach
				<td><strong>Actions</strong></td>
			</tr>
		</thead>
		<tbody>
			@foreach ($records as $record)
			<tr>
				@foreach ($index_columns as $col)
					<td>{{$record[$col]}}</td>
				@endforeach
			</tr>
			@endforeach
		</tbody>
	</table>
	
@endsection
