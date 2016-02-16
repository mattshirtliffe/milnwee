<?php

namespace MilnweeCore\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    // public $table = 'events';

    public $fillable = array(
        'id',
        'model',
        'model_id',
        'slug',
        'url',
        'created_at',
        'updated_at',
    );

    public function routeable() {
        return $this->morphTo();
    }
}
