@foreach ($languages as $language)
    <div class="form-check">
        <input class="form-check-input" type="radio" value="{{ $language->id }}"
            {{ old('course_language_id', $current_language_id ?? '') == $language->id ? 'checked' : '' }}>
        <label class="form-check-label" for="js-language-{{ $language->id }}">
            {{ $language->name }}
        </label>
    </div>
@endforeach
