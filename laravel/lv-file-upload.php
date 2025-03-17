<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait FileUpload
{
    // with unique file name
    public function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        $filename = 'educode_'. uniqid() . '_' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);
        return '/' . $directory . '/' . $filename;
    }

    // with original file name
    public function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $full_file_name = $file_name .'.'. $file->getClientOriginalExtension();
        // check if file already exists in public/uploads directory
        if (file_exists(public_path($directory . '/' . $full_file_name))) {
            $full_file_name = $file_name . '_copy.' . $file->getClientOriginalExtension();
        }

        $file->move(public_path($directory), $full_file_name);
        return '/' . $directory . '/' . $full_file_name;
    }

    public function deleteFile(string $file_path): void
    {
        if (file_exists(public_path($file_path))) {
            unlink(public_path($file_path));
        }
    }
}

class FileUploadController extends Controller
{
    use FileUpload;

    public function store(Request $request)
    {
        $file = $request->file('file');
        $path = $this->uploadFile($file);
        return response()->json(['path' => $path]);
    }

    public function destroy(Request $request, User $user)
    {

        if ($request->hasFile('image')) {
            $image_path = $user->image;
            if ($image_path) {
                $this->deleteFile($image_path);
            }
            $validated['image'] = $this->uploadFile($request->file('image'));
        }
        $user->update($validated);
    }
}
