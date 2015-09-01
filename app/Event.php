<?php

namespace Example;

use Illuminate\Database\Eloquent\Model;
use MilnweeCore\Traits\AdminCrudModel as AdminCrudModel;

class Event extends Model
{
	public $MilnweeCoreComponents = array(
		'Route' => array(
			'prefix' => 'events'
		)
	);

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
