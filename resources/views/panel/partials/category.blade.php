<div class="category-item"><label><input type="radio" name="parent" value="{{ $category->id }}" @if(isset($id) && $category->id == $id) checked="checked" @endif> {{ $category->name }}</label></div>
@if ($category->children)
    <div class="category-list">
        @each('panel.partials.category', $category->children, 'category')
    </div>
@endif
