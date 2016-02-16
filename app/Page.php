<?php

namespace Example;

use MilnweeCore\Models\MilnweeCoreModel;

class Page extends MilnweeCoreModel
{
	public $fillable = array(
		'id',
		'name',
		'body',
		'created_at',
		'updated_at',
	);
}
