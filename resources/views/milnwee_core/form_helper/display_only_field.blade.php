<label>{{ $field_data['label'] }}</label>
<input name='data[Record][{{$field_value_name}}]' type="hidden" class="form-control" value='{{ $record[$field_value_name] or ''}}'>
<input disabled type="text" class="form-control" value='{{ $record[$field_value_name] or ''}}'>
