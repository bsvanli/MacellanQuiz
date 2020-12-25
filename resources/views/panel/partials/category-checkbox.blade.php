<div class="category-item"><label><input type="checkbox" name="category[]" value="{{ $category->id }}" @if(isset($categoryIds) && in_array($category->id, $categoryIds)) checked="checked" @endif> {{ $category->name }}</label></div>
@if ($category->children)
    <div class="category-list">
        @each('panel.partials.category-checkbox', $category->children, 'category')
    </div>
@endif
