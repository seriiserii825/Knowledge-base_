<?php 
$instructor_id = Auth::user()->id;
$course_chapters = CourseChapter::where([
    'course_id' => $course->id,
    'instructor_id' => $instructor_id,
])->with('lessons')->toSql();
echo $course_chapters;
dd();
?>
