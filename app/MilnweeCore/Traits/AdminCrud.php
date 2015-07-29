<?php

namespace Example\MilnweeCore\Traits;

use Illuminate\Routing;
/**
 * @property
 */
trait AdminCrud {
	
	public function __construct() {
		parent::__construct();
		
		\Route::controller('admin/' . $this->url_slug, '\\' . $this->full_class_name);		
	}
		
	public function getIndex() {
		echo "index method of " . $this->model_class;
	}
	
}
