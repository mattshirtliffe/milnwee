@extends('milnweecore.layouts.milnwee_default')

@section('content')

<h1>Edit {{$model}} - {{$record->name}}</h1>

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#homeTab" aria-controls="homeTab" role="tab" data-toggle="tab">Home</a>
        </li>
        <li role="presentation">
            <a href="#routeableTab" aria-controls="routeableTab" role="tab" data-toggle="tab">Route</a>
        </li>
        <li role="presentation">
            <a href="#imagesTab" aria-controls="imagesTab" role="tab" data-toggle="tab">Images</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="homeTab">
            <?= $FormHelper->open(route("admin.$routeKey.update", [$record->id]), 'PUT') ?>
            <?php foreach ($fields as $field) : ?>
                <?= $FormHelper->field($field); ?>
            <?php endforeach; ?>
            <?= $FormHelper->submit('Update') ?>
            <?= $FormHelper->close() ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="routeableTab">
            <p>set a frontend route for this item</p>
        </div>
        <div role="tabpanel" class="tab-pane" id="imagesTab">
            <p>upload a new image?</p>
        </div>
    </div>

</div>
@endsection
