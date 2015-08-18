<label>{{ $field_data['label'] }}</label>
<input id='' name='data[Record][{{$field_value_name}}]' type="text" class="form-control" value='{{ $record[$field_value_name] or ''}}'>
