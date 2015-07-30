<h2>this is the admin menu</h2>

@foreach ($menu_items as $url => $name)
    <p><a href="{{ url($url) }}">{{$name}}</a></p>
@endforeach
