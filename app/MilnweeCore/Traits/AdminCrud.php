<?php

namespace Example\MilnweeCore\Traits;

use Illuminate\Routing\Route;
use Illuminate\Support\Pluralizer as Pluralizer;

trait AdminCrud {
	
	public $full_class_name;
	public $alias;
	public $model_class;
	public $url_slug;
	
	public function __construct() {
		$this->full_class_name = get_class($this);
		$this->alias = substr($this->full_class_name, strrpos($this->full_class_name, '\\') + 1);
		$this->model_class = Pluralizer::singular(str_replace('Controller', '', $this->alias));
		$this->model_class_plural = Pluralizer::plural(str_replace('Controller', '', $this->alias));
		$this->url_slug = strtolower(Pluralizer::plural($this->model_class));
	}
	
	public function initialise_admin_routes() {
		\Route::controller('admin/' . $this->url_slug, '\\' . $this->full_class_name);
	}
	
	public function getIndex() {
		
		$data = array(
			'page_data' => array(
				'model_class_singular' => $this->model_class,
				'model_class_plural' => $this->model_class_plural,
			)
		);
		$static_class = '\\Example\\' . $this->model_class;
		
		$data['records'] = $static_class::all()->toArray();;
		
		
		return view('milnwee_core.admin.index', $data);
	}
	
	public function getEdit() {
		return view('milnwee_core.admin.edit');
	}
	
	public function getAdd() {
		return view('milnwee_core.admin.add');
	}
}
