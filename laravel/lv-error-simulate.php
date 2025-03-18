<?php

function destroy(string $id)
{
    $language = CourseLanguage::find($id);
    try {
        throw ValidationException::withMessages([
            'error' => ['This is a validation error']
        ]);
        $language->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Course language delete successfully'
        ]);
    } catch (\Exception $e) {
        logger($e);
        return response([
            'status' => 'error',
            'message' => 'Something went wrong'
        ], 500);
    }
}
