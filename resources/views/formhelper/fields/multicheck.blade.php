<label>{{$label}}</label>
<input type="hidden" name='{!! $name !!}' value=''>
@foreach ($options as $key => $option)
	<div class="checkbox">
		<label>
			<input name='{!! $name !!}' value='{{$key}}' type="checkbox"> {{$option}}
		</label>
	</div>
@endforeach


