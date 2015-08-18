@extends('milnwee_core.admin.layouts.main')
@section('content')

	<hr>
	<a href="{{ route($model_info['model_url_slug'] . '.index') }}">Back to {{ $model_info['model_class_plural'] }}</a>
	<hr>
	<h1>{{ $model_info['model_class_plural'] }} <small>Adding new {{ $model_info['model_class_singular'] }}</small></h1>

	<form action="{{ route($model_info['model_url_slug'] . '.add')}}" method='post'>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		@foreach ($form_fields as $field_value_name => $field_data)
			@if (!isset($field_data['edit_only']))
				<div class="form-group">
					{!! $FormHelper->field($field_value_name, $field_data) !!}
				</div>
			@endif
		@endforeach

		<button class='btn btn-primary' type='submit'>Save</button>
		<a class='btn btn-default pull-right' href="{{ route($model_info['model_url_slug'] . '.index') }}">Cancel</a>

	</form>

@endsection
