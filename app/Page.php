<?php

namespace Example;

use Illuminate\Database\Eloquent\Model;
use Example\MilnweeCore\Traits\AdminCrudModel as AdminCrudModel;

class Page extends Model
{
	public $indexColumns = array(
		'id' => array(
			'label' => 'ID'
		),
		'name' => array(
			'label' => 'Name'
		),
		'created_at' => array(
			'label' => 'Created'
		),
	);

	public $fillable = array(
		'id',
		'name',
		'body',
		'created_at',
	);
}
