<?php

namespace Example;

use MilnweeCore\Models\MilnweeCoreModel;
use MilnweeCore\Traits\RouteableTrait;

class Event extends MilnweeCoreModel
{
	use RouteableTrait;

	public $fillable = array(
		'id',
		'name',
		'body',
		'created_at',
		'updated_at',
	);


}
