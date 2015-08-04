<?php

namespace Example;

use Illuminate\Database\Eloquent\Model;
use Example\MilnweeCore\Traits\AdminCrudModel as AdminCrudModel;

class Event extends Model
{
	use AdminCrudModel;
}
