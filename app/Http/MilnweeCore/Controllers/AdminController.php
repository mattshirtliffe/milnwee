<?php

namespace Example\Http\MilnweeCore\Controllers;

class AdminController extends MilnweeCoreController
{
	public function getIndex() {
		return view('milnwee_core.admin.index');
	}
	
	public function getTest() {
		return view('milnwee_core.admin.test');
	}
}
