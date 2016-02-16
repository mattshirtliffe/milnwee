<?php

namespace MilnweeCore\Traits;

trait ImagesTrait {
    public function images(){
        return $this->morphOne('MilnweeCore\Models\Route', 'routeable');
    }

    public function saveImages($model, $associationData) {
        if (!empty($associationData['id'])) {
            $route = Route::find($associationData['id']);
        } else {
            $route = new Route();
        }

        $route->routeable_id = $model->id;
        $route->routeable_type = get_class($model);
        foreach ($associationData as $key => $value) {
            if ($key == 'slug') {
                $value = str_slug($value);
            }
            $route->$key = $value;
        }

        $route->save();
    }
}
