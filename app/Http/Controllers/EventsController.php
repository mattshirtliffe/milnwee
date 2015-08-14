<?php

namespace Example\Http\Controllers;

use Example\MilnweeCore\Traits\AdminCrud as AdminCrud;
use Illuminate\Routing\Controller as BaseController;

class EventsController extends BaseController {
	use AdminCrud;
}
