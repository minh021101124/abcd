@foreach ($categories as $categoryOption)
    <option value="{{ $categoryOption->id }}" {{ $product->category->parent_id == $categoryOption->id ? 'selected' : '' }}>
        {{ $prefix }} {{ $categoryOption->name }}
    </option>
    <?php $displayedCategories[] = $categoryOption->id; ?>
    @if(count($categoryOption->children))
        @include('partials.product-options', ['categories' => $categoryOption->children, 'product' => $product, 'prefix' => $prefix . '--'])
    @endif
@endforeach
