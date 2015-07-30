<?php

namespace Example\Http\Controllers;

use Example\Http\MilnweeCore\Controllers\MilnweeCoreController;
use Example\MilnweeCore\Traits\AdminCrud;
use Example\MilnweeCore\Traits\AdminMenuInclude;

class EventsController extends MilnweeCoreController
{
	use AdminCrud;
	use AdminMenuInclude;
}
