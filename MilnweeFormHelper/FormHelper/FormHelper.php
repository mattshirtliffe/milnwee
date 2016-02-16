<?php

namespace MilnweeFormHelper\FormHelper;

use Illuminate\Support\Facades\View;

use MilnweeFormHelper\FormHelper\FieldBuilder;

class FormHelper {

	protected $_fieldBuilder = null;

	protected $_baseModel = null;
	protected $_requestData = array();


	protected $_extraModels = array();

	protected $_fieldSettings = array();

	protected $_name = array();
	protected $_type = array();

	public function __construct($baseModel = null, $requestData = array()) {
		if (!empty($baseModel)) {
			$this->setBaseModel($baseModel);
		}
		if (!empty($requestData)) {
			$this->setRequestData($requestData);
		}
	}

	public function __toString() {
		return $this->toHtml();
	}

	public function toHtml() {
		$this->_fieldBuilder = new FieldBuilder($this->_fieldSettings);

		$this->_fieldBuilder->setBaseModel($this->_baseModel);
		$this->_fieldBuilder->setExtraModels($this->_extraModels);

        $this->_requestData = array_dot($this->_requestData);

		$this->_fieldBuilder->setData($this->_requestData);

		$html = $this->_fieldBuilder->build();

		$this->_reset();
		return $html;
	}

	protected function _reset() {
		$this->_fieldBuilder = null;
        $this->_fieldSettings = array();
        $this->_extraModels = array();
		return $this;
	}

	protected function _guessTypeForName($name) {
		$type = 'text';

        $nameChunks = explode('.', $name);

		switch (end($nameChunks)) {
			case 'id' :
				$type = 'hidden';
				break;
			case 'body' :
			case 'description' :
				$type = 'textarea';
				break;
			case 'email' :
				$type = 'email';
			case 'created_at' :
			case 'updated_at' :
				$type = 'readonly';
				break;
		}

		return $type;
	}

	public function field($name, $attributes = array()) {
		$this->_fieldSettings['name'] = $name;

		// guess type based on name
		$this->_fieldSettings['type'] = $this->_guessTypeForName($name);
		$this->_fieldSettings = array_merge($this->_fieldSettings, $attributes);

		return $this;
	}

	public function setRequestData($requestData) {
		$this->_requestData = $requestData;

		return $this;
	}

	public function setBaseModel($model) {
		$this->_baseModel = $model;

		return $this;
	}

	public function addExtraModel($extraModel) {
		$this->_extraModels[] = $extraModel;

		return $this;
	}

	public function open($url, $method = 'POST') {
		return view('formhelper.open_form', array(
			'action' => $url,
			'method' => $method,
		))->__toString();
	}

	public function close() {
		return "</form>";
	}

	public function submit($name = '', $type = 'submit') {
		if (empty($name)) {
			$name = 'Submit';
		}

		return view('formhelper.fields.button', array(
			'name' => $name,
			'type' => $type,
		))->__toString();
	}

	public function readOnly() {
		$this->_fieldSettings['type'] = 'readonly';

		return $this;
	}
}
