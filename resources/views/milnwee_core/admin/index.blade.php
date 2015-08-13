@extends('milnwee_core.admin.layouts.main')
@section('content')
	<h1>{{ $model_data['model_class_plural'] }}</h1>
	
	<hr>
		<a href="{{ route($model_data['model_url_slug'] . '.add') }}" class="btn btn-primary">Add new {{ $model_data['model_class_singular'] }}</a>
	<hr>
	
	<table>
		<thead>
			<tr>
				@foreach ($index_columns as $col_value => $col_data)
					<td><strong>{{ucwords($col_data['label'])}}</strong></td>
				@endforeach
				<td><strong>Actions</strong></td>
			</tr>
		</thead>
		<tbody>
			@foreach ($records as $record)
			<tr>
				@foreach ($index_columns as $col_value => $col_data)
					<td>{{$record[$col_value]}}</td>
				@endforeach
				<td>
					<a href="{{ route($model_data['model_url_slug'] . '.edit', $record['id']) }}" class="btn btn-primary">Edit</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
@endsection
