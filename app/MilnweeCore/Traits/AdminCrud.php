<?php

namespace MilnweeCore\Traits;

use Illuminate\Routing\Route;
use Illuminate\Support\Pluralizer as Pluralizer;
use Example\Event as Event;
use Illuminate\Http\Request;
use MilnweeCore\ViewHelpers\Formhelper;

trait AdminCrud {

	public $full_controller_class_name = null;
	public $full_model_class_name = null;
	public $alias = null;
	public $model_class = null;
	public $model_class_plural = null;
	public $url_slug = null;

	public $view_vars = array();

	public $Model = null;

	public function admin__initialise_automatic_admin() {

		$this->prepareControllerData();

		\Route::controller('admin/' . $this->url_slug, '\\' . $this->full_controller_class_name, array(
			'getIndex' => $this->url_slug,
			'getIndex' => $this->url_slug.'.index',
			'getEdit' => $this->url_slug . '.edit',
			'postEdit' => $this->url_slug . '.edit',
			'getAdd' => $this->url_slug . '.add',
			'postAdd' => $this->url_slug . '.add',
			'getDelete' => $this->url_slug . '.delete',
		));
	}

	public function prepareControllerData() {

		/*
		first, we prepare the base data values for names of classes and namespaces
		 */
		$this->full_controller_class_name = get_class($this);
		$this->alias = substr($this->full_controller_class_name, strrpos($this->full_controller_class_name, '\\') + 1);
		$this->model_class = Pluralizer::singular(str_replace('Controller', '', $this->alias));
		$this->model_class_plural = Pluralizer::plural(str_replace('Controller', '', $this->alias));
		$this->url_slug = strtolower(Pluralizer::plural($this->model_class));

		$this->model_info = array(
			'model_class_singular' => $this->model_class,
			'model_class_plural' => $this->model_class_plural,
			'model_url_slug' => $this->url_slug
		);

		if (empty($this->model_namespace_path)) {
			$this->model_namespace_path = '\\Example\\';
		}

		$this->full_model_class_name = $this->model_namespace_path . $this->model_class;
		$this->Model = new $this->full_model_class_name;

		/*
		then we attach any of the milnweecore components
		 */

		foreach ($this->MilnweeCoreComponents as $componentName => $component) {

			if (is_array($component)) {

			} else {
				$this->attachMilnweeCoreComponentDefaults($component)
			}
		}
	}

	private function generateCrudColumns() {
		$this->prepareControllerData();

		dd($this->Model->indexColumns);

		return $cols;
	}

	private function attachMilnweeCoreComponentDefaults($componentName) {

	}

	private function generateAdminFormFields() {

		$fields = array(
			'id' => array(
				'label' => 'ID',
				'type' => 'id',
				'edit_only' => true
			),
			'name' => array(
				'label' => 'Name',
				'type' => 'string',
			),
			'body' => array(
				'label' => 'Body',
				'type' => 'text',
			),
			'created_at' => array(
				'label' => 'Created At',
				'type' => 'datetime',
				'edit_only' => true
			),
		);

		return $fields;
	}

	/**
	 * primary action for indexing
	 */
	public function getIndex($view = 'milnwee_core.admin.index') {
		$this->admin__initialise_automatic_admin();

		$data = array();

		$model = $this->model_namespace_path . $this->model_class;

		$data['records'] = $model::all()->toArray();

		$data['index_columns'] = $this->Model->indexColumns;

		return $this->view($view, $data);
	}

	public function getEdit($id, $view = 'milnwee_core.admin.edit') {

		$this->prepareControllerData();

		$data = array();

		$model = $this->model_namespace_path . $this->model_class;

		$data['record'] = $model::find($id)->toArray();

		$data['form_fields'] = $this->generateAdminFormFields();

		return $this->view($view, $data);
	}

	public function postEdit(Request $request) {

		$this->prepareControllerData();

		$model = $this->model_namespace_path . $this->model_class;

		$data = $request->all();

		$record = $model::find($data['data']['Record']['id']);

		foreach ($data['data']['Record'] as $field_name => $field_data) {
			$record->$field_name = $field_data;
		}

		$record->save();

		return redirect(route($this->url_slug . '.index'));
	}

	public function getAdd($view = 'milnwee_core.admin.add') {

		$this->prepareControllerData();

		$data['form_fields'] = $this->generateAdminFormFields();

		return $this->view($view, $data);
	}

	public function postAdd(Request $request) {

		$this->prepareControllerData();

		$model = $this->model_namespace_path . $this->model_class;

		$data = $request->all();

		$model::create($data['data']['Record'])->save();

		return redirect(route($this->url_slug . '.index'));
	}

	public function getDelete($id) {

		$this->prepareControllerData();

		$model = $this->model_namespace_path . $this->model_class;

		$model::destroy($id);

		return redirect(route($this->url_slug . '.index'));
	}

	public function getView($id) {

	}

	public function view($view, $data = array()) {
		$data['model_info'] = $this->model_info;
		$data['FormHelper'] = new FormHelper();
		return view($view, $data);
	}
}
