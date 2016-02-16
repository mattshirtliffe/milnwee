<?php

namespace MilnweeCore\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

use MilnweeBreadcrumbs\BreadcrumbBuilder;

/**
 * this controller handles default stuff that happens in the controller that isnt associated with
 * a particular controller/model
 */
class MilnweeDefaultController extends BaseController
{
	public function getIndex() {

		$controllers = \Config::get('milnwee.controllers');
		$breadcrumbs = new BreadcrumbBuilder();
		return view('milnweecore.default', array(
			'breadcrumbs' => $breadcrumbs,
			'controllers' => $controllers
		));
	}
}
