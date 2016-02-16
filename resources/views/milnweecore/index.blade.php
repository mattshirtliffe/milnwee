@extends('milnweecore.layouts.milnwee_default')

@section('content')
<h1>{{str_plural($model)}}</h1>
<table class='table table-striped'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($items as $item) : ?>
    		<tr>
    			<td>{{$item->id}}</td>
    			<td>{{$item->name}}</td>
    			<td><a class='btn btn-primary' href="<?= route("admin.$routeKey.edit", [$item->id]) ?>"><i class="fa fa-pencil"></i> Edit</a></td>
    			<td>
    				<form action='<?= route("admin.$routeKey.destroy", [$item->id]) ?>' method='post'>
    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
    					<input name="_method" type="hidden" value="DELETE">
    					<button class='btn btn-danger' type='submit'>Delete</button>
    				</form>
    			</td>
    		</tr>
    	<?php endforeach; ?>
    </tbody>
</table>
<a class='btn btn-default' href="<?= route("admin.$routeKey.create") ?>">Add new {{$model}}</a>
@endsection
