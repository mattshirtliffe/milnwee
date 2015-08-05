<?php

namespace Example\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Example\MilnweeCore\Traits\AdminCrud as AdminCrud;

class EventsController extends BaseController
{
	use AdminCrud;
	
}
