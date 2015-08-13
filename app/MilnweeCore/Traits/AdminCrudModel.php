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
}
