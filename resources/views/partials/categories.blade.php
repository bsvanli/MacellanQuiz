@if ($categories->count())
    <ul>
        @foreach ($categories as $category)
            @include('partials.category', $category)
        @endforeach
    </ul>
@endif
