<?php

namespace Example\MilnweeCore\ViewHelpers;

class FormHelper
{
	public function field($field_value_name, $field_data, $record = null) {

		$data = array(
			'field_value_name' => $field_value_name,
			'field_data' => $field_data,
			'record' => $record,
		);

		$html = '';
		switch ($field_data['type']) {
			case 'id':
				$html = view('milnwee_core.form_helper.id_field', $data);
				break;
			case 'string':
				$html = view('milnwee_core.form_helper.string_field', $data);
				break;
			case 'text':
				$html = view('milnwee_core.form_helper.text_field', $data);
				break;
			case 'datetime':
				$html = view('milnwee_core.form_helper.datetime', $data);
				break;
		}

		return $html;
	}
}
