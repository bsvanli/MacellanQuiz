<li><label><input type="radio" name="category" value="{{ $child->id }}" @if(isset($id) && $id == $child->id) checked="checked" @endif/> {{ $child->name }}</label></li>
@if ($categories->where('parent_id', $child->id))
    <ul>
        @foreach ($categories->where('parent_id', $child->id) as $child)
            @include('panel.partials.category', ['child' => $child, 'categories' => $categories])
        @endforeach
    </ul>
@endif
