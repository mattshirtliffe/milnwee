@extends('milnwee_core.admin.layouts.main')
@section('content')

	<hr>
	<a href="{{ route($model_info['model_url_slug'] . '.index') }}">Back to {{ $model_info['model_class_plural'] }}</a>
	<hr>
	<h1>{{ $model_info['model_class_plural'] }} <small>Adding new {{ $model_info['model_class_singular'] }}</small></h1>

	<form action="{{ route($model_info['model_url_slug'] . '.add')}}" method='post'>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		@foreach ($form_fields as $field_value_name => $field_data)
			
		<div class="form-group">
			
			<label for="exampleInputEmail1">{{$field_data['label']}}</label>
			
			@if ($field_data['type'] == 'string')
				<input name='data[Record][{{$field_value_name}}]' type="text" class="form-control">
			@endif
			
			@if ($field_data['type'] == 'text')
				<textarea name='data[Record][{{$field_value_name}}]' class="form-control" rows="3"></textarea>
			@endif			
		</div>
		
		@endforeach
		
		<button class='btn btn-primary' type='submit'>Save</button>
		<a class='btn btn-default pull-right' href="{{ route($model_info['model_url_slug'] . '.index') }}">Cancel</a>

	</form>
	
@endsection
