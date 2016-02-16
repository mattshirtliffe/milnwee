<?php

namespace MilnweeFormHelper\FormHelper;

use Illuminate\Support\Facades\View;

class FieldBuilder {

	protected $_settings = array();

	protected $_baseModel = array();
	protected $_extraModels = array();
	protected $_data = array();

	public function __construct($settings) {
		$this->_settings = $settings;
		return $this;
	}

	public function setSettings($settings) {
		$this->_settings = $settings;
	}

	protected function _substituteTypes() {
		switch ($this->_settings['type']) {
			case 'string' :
			$this->_settings['type'] = 'text';
				break;
		}
	}

	protected function _buildNamesAndLabels() {
		$tempSettings = array();

		// if we have any extra models, add them on
		$extraModels = array_reverse($this->_extraModels);
		foreach($extraModels as $extraModel) {
			$this->_settings['name'] = $extraModel . '.' . $this->_settings['name'];
		}

		if (!empty($this->_baseModel)) {
			$this->_settings['name'] = $this->_baseModel . '.' . $this->_settings['name'];
		}

		// keep hold of the dot notation name
		$this->_settings['dot_notation_name'] = $this->_settings['name'];

		// build a label and a name
		$nameChunks = explode('.', $this->_settings['name']);

		$tempSettings['label'] = ucwords(str_replace('_', ' ', end($nameChunks)));
		$name = 'data';
		foreach ($nameChunks as $nc) {
			$name .= '[' . $nc . ']';
		}
		$tempSettings['name'] = $name;

		unset($this->_settings['name']);

		$this->_settings = array_merge($tempSettings, $this->_settings);
		return $this;
	}

	public function setBaseModel($baseModel) {
		$this->_baseModel = $baseModel;

		return $this;
	}

	public function setExtraModels($extraModels) {
		$this->_extraModels = $extraModels;

		return $this;
	}

	public function setData($data) {
		$this->_data = $data;
	}

	protected function _addValue() {
        if (array_has($this->_data, $this->_settings['dot_notation_name'])) {
			$this->_settings['value'] = array_get($this->_data, $this->_settings['dot_notation_name']);
		}
		return $this;
	}

	public function build() {
		$this->_substituteTypes();
		$this->_buildNamesAndLabels();
		$this->_addValue();

		return view('formhelper.fields.' . $this->_settings['type'], $this->_settings)->__toString();
	}
}
