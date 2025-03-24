<?php 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $chapter = new CourseChapter();
        $chapter->fill($validated);
        $chapter->instructor_id = Auth::id();
        $chapter->course_id = $validated['course_id'];
        $chapter->order = CourseChapter::where('course_id', $validated['course_id'])->count() + 1;
        $chapter->save();

        // return validation errors
        if ($chapter->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Chapter creation failed',
                'errors' => $chapter->errors(),
            ], 422);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Chapter created successfully',
            'data' => $chapter,
        ]);
    }
