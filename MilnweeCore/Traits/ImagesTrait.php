<?php

namespace MilnweeCore\Traits;

trait ImagesTrait {
    public function images(){
        return $this->morphOne('MilnweeCore\Models\Image', 'imageable');
    }

    public function saveImages($model, $associationData) {
        if (!empty($associationData['id'])) {
            $image = Image::find($associationData['id']);
        } else {
            $image = new Image();
        }

        $image->routeable_id = $model->id;
        $image->routeable_type = get_class($model);
        foreach ($associationData as $key => $value) {
            if ($key == 'slug') {
                $value = str_slug($value);
            }
            $image->$key = $value;
        }

        $image->save();
    }
}
