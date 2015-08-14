<?php

namespace Example\MilnweeCore\Traits;

use Illuminate\Routing\Route;
use Illuminate\Support\Pluralizer as Pluralizer;
use Example\Event as Event;
use Illuminate\Http\Request;

trait AdminCrud {
	
	public $full_class_name;
	public $alias;
	public $model_class;
	public $model_class_plural;
	public $url_slug;
	
	public $index_columns = array();
	
	public $admin_index_columns = array();
	public $admin_form_fields = array();
	
	public function admin__initialise_automatic_admin() {
		
		$this->prepareControllerData();
		
		\Route::controller('admin/' . $this->url_slug, '\\' . $this->full_class_name, array(
			'getIndex' => $this->url_slug,
			'getIndex' => $this->url_slug.'.index',
			'getEdit' => $this->url_slug . '.edit',
			'postEdit' => $this->url_slug . '.edit',
			'getAdd' => $this->url_slug . '.add',
			'getDelete' => $this->url_slug . '.delete',
		));
	}
	
	public function prepareControllerData() {
		$this->full_class_name = get_class($this);
		$this->alias = substr($this->full_class_name, strrpos($this->full_class_name, '\\') + 1);
		$this->model_class = Pluralizer::singular(str_replace('Controller', '', $this->alias));
		$this->model_class_plural = Pluralizer::plural(str_replace('Controller', '', $this->alias));
		$this->url_slug = strtolower(Pluralizer::plural($this->model_class));
	}
	
	private function generateCrudColumns() {
		
		$cols = array(
			'name' => array(
				'label' => 'Name'
			),
			'body' => array(
				'label' => 'Body'
			),
			'created_at' => array(
				'label' => 'Created At'
			),
			'updated_at' => array(
				'label' => 'Updated At'
			),
		);
		
		return $cols;
	}
	
	private function generateAdminFormFields() {
				
		$fields = array(
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
				'type' => 'display_only',
			),
		);
		
		return $fields;
	}
	
	public function getIndex($view = 'milnwee_core.admin.index') {
		$this->admin__initialise_automatic_admin();
		
		$data = array(
			'model_data' => array(
				'model_class_singular' => $this->model_class,
				'model_class_plural' => $this->model_class_plural,
				'model_url_slug' => $this->url_slug
			)
		);
		
		$model = '\\Example\\' . $this->model_class;
		
		$data['records'] = $model::all()->toArray();
		
		$data['index_columns'] = $this->generateCrudColumns();
		
		return view($view, $data);
	}
	
	public function getEdit($id, $view = 'milnwee_core.admin.edit') {
		
		$this->prepareControllerData();
		
		$data = array(
			'model_data' => array(
				'model_class_singular' => $this->model_class,
				'model_class_plural' => $this->model_class_plural,
				'model_url_slug' => $this->url_slug
			)
		);
		
		$model = '\\Example\\' . $this->model_class;
		
		$data['record'] = $model::find($id)->toArray();
		
		$data['form_fields'] = $this->generateAdminFormFields();
		
		return view($view, $data);
	}
	
	public function postEdit(Request $request, $view = 'milnwee_core.admin.edit') {
		$this->admin__initialise_automatic_admin();
		
		$model_data = array(
			'model_class_singular' => $this->model_class,
			'model_class_plural' => $this->model_class_plural,
			'model_url_slug' => $this->url_slug
		);
		
		$model = '\\Example\\' . $this->model_class;
		
		$data = $request->all();
		
		$record = $model::find($data['data']['Record']['id']);
		
		foreach ($data['data']['Record'] as $field_name => $field_data) {
			$record->$field_name = $field_data;
		}
		
		$record->save();
		
		return redirect('admin/events');
	}
	
	public function getAdd($view = 'milnwee_core.admin.add') {
		
		$this->admin__initialise_automatic_admin();
		
		$data = array(
			'model_data' => array(
				'model_class_singular' => $this->model_class,
				'model_class_plural' => $this->model_class_plural,
				'model_url_slug' => $this->url_slug
			)
		);
		
		return view($view, $data);
	}
	
	public function getDelete($id) {
		$this->prepareControllerData();
		
		
		
		
	}
	
	public function view($view, $data = array()) {
		parent::view($view, $data);
	}
}
