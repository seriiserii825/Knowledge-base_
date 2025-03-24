$validator = Validator::make($request->all(), [
    'title' => 'required|string|max:255',
    'seo_description' => 'required|string',
    'demo_video_storage' => 'required|string',
    'price' => 'required|numeric',
    'discount' => 'required|numeric',
    'description' => 'required|string',
    'thumbnail' => 'nullable|image',
]);

if ($validator->fails()) {
    dd($validator->errors());  // Show validation errors instead of redirecting
}

$validated = $validator->validated();
