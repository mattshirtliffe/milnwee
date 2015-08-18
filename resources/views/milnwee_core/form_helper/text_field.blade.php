<label>{{ $field_data['label'] }}</label>
<textarea name='data[Record][{{$field_value_name}}]' class="form-control" rows="3">{{$record[$field_value_name] or ''}}</textarea>
