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



<!-- select component -->
@props(['name', 'value' => '', 'label' => '', 'id' => '', 'options' => []])
@if ($label)
    <label class="form-label">{{ $label }}</label>
@endif
<select class="form-select form-control" id="{{ $id }}" name="{{ $name }}">
    @foreach ($options as $option_value => $label)
        <option value="{{ $option_value }}"
            {{ old($name, $value ?? '') == $option_value ? 'selected' : '' }}
            >
            {{ $label }}
        </option>
    @endforeach
</select>
