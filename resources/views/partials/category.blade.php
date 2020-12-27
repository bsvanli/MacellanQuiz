<a href="{{ route('site.category', $category->id) }}" class="list-group-item">{{ $category->name }} <span class="count">{{ number_format($category->product_count) }}</span></a>
@if ($category->children)
    <div class="list-group">
        @each('partials.category', $category->children, 'category')
    </div>
@endif

