@extends('milnwee_core.admin.layouts.main')
@section('content')
	
	<hr>
	<a href="{{ route($model_info['model_url_slug'] . '.index') }}">Back to {{ $model_info['model_class_plural'] }}</a>
	<hr>
	<h1>{{ $record['name'] }} <small>Editing</small></h1>
	<hr>
	<form action="{{ route($model_info['model_url_slug'] . '.edit')}}" method='post'>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		@foreach ($form_fields as $field_value_name => $field_data)
			
		<div class="form-group">
			<input name='data[Record][id]' type="hidden" class="form-control" value='{{ $record["id"] }}'>
			<label for="exampleInputEmail1">{{$field_data['label']}}</label>
			
			@if ($field_data['type'] == 'string')
				<input name='data[Record][{{$field_value_name}}]' type="text" class="form-control" value='{{ $record[$field_value_name] }}'>
			@endif
			
			@if ($field_data['type'] == 'text')
				<textarea name='data[Record][{{$field_value_name}}]' class="form-control" rows="3">{{$record[$field_value_name]}}</textarea>
			@endif
			
			@if ($field_data['type'] == 'display_only')
				<input name='data[Record][{{$field_value_name}}]' type="hidden" class="form-control" value='{{ $record[$field_value_name] }}'>
				<input disabled type="text" class="form-control" value='{{ $record[$field_value_name] }}'>
			@endif
		</div>
		
		@endforeach
		
		<button class='btn btn-primary' type='submit'>Update</button>
		<a class='btn btn-default pull-right' href="{{ route($model_info['model_url_slug'] . '.index') }}">Cancel</a>
	</form>
	
@endsection
