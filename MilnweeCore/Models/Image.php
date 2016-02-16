<?php

namespace MilnweeCore\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $fillable = array(
        'id',
        'model',
        'model_id',
        'slug',
        'url',
        'created_at',
        'updated_at',
    );

    public function imageable() {
        return $this->morphTo();
    }
}
