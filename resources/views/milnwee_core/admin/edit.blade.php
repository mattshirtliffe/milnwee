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
			{!! $FormHelper->field($field_value_name, $field_data, $record) !!}
		</div>

		@endforeach

		<button class='btn btn-primary' type='submit'>Update</button>
		<a class='btn btn-default pull-right' href="{{ route($model_info['model_url_slug'] . '.index') }}">Cancel</a>
	</form>

@endsection
