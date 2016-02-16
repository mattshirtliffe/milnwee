@extends('milnweecore.layouts.milnwee_default')

@section('content')
<h1>Add new {{$model}}</h1>

<?php echo $FormHelper->open(route('admin.' . $routeKey . '.store')); ?>

<?php foreach ($fields as $field) : ?>
	<?php echo $FormHelper->field($field); ?>
<?php endforeach; ?>

<?php echo $FormHelper->submit() ?>

<?php echo $FormHelper->close(); ?>
@endsection

