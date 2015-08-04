<?php

namespace Example\MilnweeCore;

trait AdminCrud {
	
	public function getIndexColumns() {		
		$columns = array(
			
		);
	}
	
	public function getEdit() {
		return view('milnwee_core.admin.edit');
	}
	
	public function getAdd() {
		return view('milnwee_core.admin.add');
	}
}
