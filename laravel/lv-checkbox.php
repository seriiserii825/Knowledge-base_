<input name="qna" value="1" class="form-check-input" type="checkbox"
    id="flexCheckDefault" @checked($course->qna == 1)>

@foreach ($languages as $language)
<div class="form-check">
    <input class="form-check-input" type="radio" value="{{ $language->id }}"
        {{ old('course_language_id', $current_language_id ?? '') == $language->id ? 'checked' : '' }}>
    <label class="form-check-label" for="js-language-{{ $language->id }}">
        {{ $language->name }}
    </label>
</div>
@endforeach


<div class="add_course_more_info_checkbox">
    <div class="form-check">
        <input name="qna" value="1" class="form-check-input" type="checkbox"
            id="flexCheckDefault" {{ old('qna', $course->qna) ? 'checked' : '' }}>
        <label class="form-check-label" for="flexCheckDefault">Q&A</label>
    </div>
    <div class="form-check">
        <input name="certificate" value="1" class="form-check-input" type="checkbox"
            id="flexCheckDefault2" {{ old('certificate', $course->certificate) ? 'checked' : '' }}>
        <label class="form-check-label" for="flexCheckDefault2">Completion Certificate</label>
    </div>
</div>
