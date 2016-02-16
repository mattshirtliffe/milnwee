<label>{{$label}}</label>
<select name='{{$name}}' id='{{$id}}' class="form-control">
	@if ($allow_empty)
	    <option value="">Please select...</option>
	@endif
	@foreach ($options as $key => $option)
		<option value="{{$key}}">{{$option}}</option>
	@endforeach
</select>
