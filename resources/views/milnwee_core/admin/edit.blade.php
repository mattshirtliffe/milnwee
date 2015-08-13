@extends('milnwee_core.admin.layouts.main')
@section('content')
    
    <hr>
    <a href="{{ route($model_data['model_url_slug'] . '.index') }}">Back to {{ $model_data['model_class_plural'] }}</a>
    <hr>
    <h1>{{ $record['name'] }} <small>Editing</small></h1>
    <hr>
    <form>
	    @foreach ($form_fields as $field_value_name => $field_data)
	    	
		<div class="form-group">
			<label for="exampleInputEmail1">{{$field_data['label']}}</label>
			
			@if ($field_data['type'] == 'string')
				<input type="text" class="form-control" value='{{ $record[$field_value_name] }}'>
			@endif
			
			@if ($field_data['type'] == 'text')
				<textarea class="form-control" rows="3">{{$record[$field_value_name]}}</textarea>
			@endif
			
			@if ($field_data['type'] == 'display_only')
				<input disabled type="text" class="form-control" value='{{ $record[$field_value_name] }}'>
			@endif
		</div>
		
	    @endforeach
    </form>
    
@endsection
