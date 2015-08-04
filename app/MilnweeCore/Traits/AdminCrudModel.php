<?php

namespace Example\MilnweeCore\Traits;

trait AdminCrudModel {
	
	public static function getIndexColumns() {
		$columns = array(
			'name',
			'body',
		);
		
		return $columns;
	}
	
	public function getEdit() {
		return view('milnwee_core.admin.edit');
	}
	
	public function getAdd() {
		return view('milnwee_core.admin.add');
	}
}
