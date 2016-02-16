<label for="{{ $dot_notation_name }}">{{$label}}</label>
<textarea
placeholder='Please enter {{$label}}'
name='{!! $name !!}'
value='{{ $value or '' }}'
class="form-control"
id="{{ $dot_notation_name }}" rows="6">{{$value or ''}}</textarea>
