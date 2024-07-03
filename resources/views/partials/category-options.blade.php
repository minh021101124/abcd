@foreach ($categories as $childCategory)
    <option value="{{ $childCategory->id }}" {{ $category->parent_id == $childCategory->id ? 'selected' : '' }}>
        {{ $prefix }} {{ $childCategory->name }}
    </option>
    <?php $displayedCategories[] = $childCategory->id; ?>
    @if(count($childCategory->children))
        @include('partials.category-options', ['categories' => $childCategory->children, 'prefix' => $prefix . '--'])
    @endif
@endforeach
