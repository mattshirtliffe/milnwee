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
		return view('milnwee_core.admin.index');
	}
	
	public function getEdit() {
		return view('milnwee_core.admin.edit');
	}
	
	public function getAdd() {
		return view('milnwee_core.admin.add');
	}
}
