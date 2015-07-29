<?php

namespace Example\Http\MilnweeCore\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Pluralizer as Pluralizer;

class MilnweeCoreController extends BaseController
{
	public $full_class_name;
	public $alias;
	public $model_class;
	public $url_slug;
	
	public function __construct() {
		$this->full_class_name = get_class($this);
		$this->alias = substr($this->full_class_name, strrpos($this->full_class_name, '\\') + 1);
		$this->model_class = Pluralizer::singular(str_replace('Controller', '', $this->alias));
		$this->url_slug = strtolower(Pluralizer::plural($this->model_class));
	}
}
