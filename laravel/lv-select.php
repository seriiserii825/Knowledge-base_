<select class="select_2" name="category_id">
    <option value=""> Please Select </option>
    @foreach ($categories as $category)
    @if ($category->subcategories->isNotEmpty())
    <optgroup label="{{ $category->name }}">
        @foreach ($category->subcategories as $subcategory)
        <option
            {{ old('category_id', $current_category_id ?? '') == $subcategory->id ? 'selected' : '' }}
            value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
        @endforeach
    </optgroup>
    @endif
    @endforeach
</select>
