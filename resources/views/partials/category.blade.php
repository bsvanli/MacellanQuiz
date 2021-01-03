<li><a href="{{ route('site.category', $child->id) }}">{{ $child->name }}<span class="cat-count">{{ $child->total_count }}</span></a></li>
@if ($categories->where('parent_id', $child->id))
    <ul>
        @foreach ($categories->where('parent_id', $child->id) as $child)
            @include('partials.category', ['child' => $child, 'categories' => $categories])
        @endforeach
    </ul>
@endif
