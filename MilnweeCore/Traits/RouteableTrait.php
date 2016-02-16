<?php

namespace MilnweeCore\Traits;

use MilnweeCore\Models\Route;

trait RouteableTrait {
    public function route(){
        return $this->morphOne('MilnweeCore\Models\Route', 'routeable');
    }

    public function saveRoute($model, $associationData) {

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
