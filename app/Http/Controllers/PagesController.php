<?php

namespace Example\Http\Controllers;

use Example\MilnweeCore\Traits\AdminCrud as AdminCrud;
use Illuminate\Routing\Controller as BaseController;

class PagesController extends BaseController {
	use AdminCrud;
}
