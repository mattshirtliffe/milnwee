<?php

namespace Example;

use Illuminate\Database\Eloquent\Model;
use Example\MilnweeCore\Traits\AdminCrudModel as AdminCrudModel;

class Event extends Model
{
	protected $fillable = array(
		'id',
		'name',
		'body',
		'created_at',
	);
}
