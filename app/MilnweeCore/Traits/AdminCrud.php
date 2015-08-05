<?php

namespace Example\MilnweeCore\Traits;

use Illuminate\Routing\Route;
use Illuminate\Support\Pluralizer as Pluralizer;

trait AdminCrud {
	
	public $full_class_name;
	public $alias;
	public $model_class;
	public $model_class_plural;
	public $url_slug;
	
	public $index_columns = array();
		
	public function admin__initialise_automatic_admin() {
		
		$this->full_class_name = get_class($this);
		$this->alias = substr($this->full_class_name, strrpos($this->full_class_name, '\\') + 1);
		$this->model_class = Pluralizer::singular(str_replace('Controller', '', $this->alias));
		$this->model_class_plural = Pluralizer::plural(str_replace('Controller', '', $this->alias));
		$this->url_slug = strtolower(Pluralizer::plural($this->model_class));
		
		\Route::controller('admin/' . $this->url_slug, '\\' . $this->full_class_name, array(
			'getIndex' => $this->url_slug.'.index',
			'getIndex' => $this->url_slug,
			'getEdit' => $this->url_slug . '.edit',
			'getAdd' => $this->url_slug . '.add',
		));
		
		$this->admin__populate_index_columns();
	}
	
	protected function admin__populate_index_columns() {
		$cols = array();
		
		$cols[] = 'name';
		
		
		return $cols;
	}
	
	public function getIndex($view = 'milnwee_core.admin.index') {
		
		$data = array(
			'model_data' => array(
				'model_class_singular' => $this->model_class,
				'model_class_plural' => $this->model_class_plural,
				'model_url_slug' => $this->url_slug
			)
		);
		$model = '\\Example\\' . $this->model_class;
		
		$data['records'] = $model::all()->toArray();
		$data['index_columns'] = $this->index_columns;
		
		return view($view, $data);
	}
	
	public function getEdit($view = 'milnwee_core.admin.edit') {
		return view($view);
	}
	public function getAdd($view = 'milnwee_core.admin.add') {
		return view($view);
	}
}
