<!-- install api -->

php artisan install:api

<!-- in web.php comment route -->

<!-- create AuthController -->

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use FileUpload;
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:student,instructor',
        ]);
        $fields['password'] = Hash::make($fields['password']);
        if ($request->role == 'student') {
            $fields['approve_status'] = 'initial';
        } else {
            $request->validate(['document' => 'required|file|mimes:pdf,doc,docx']);
            $fields['document'] = $this->uploadFile($request->file('document'));
            $fields['approve_status'] = 'pending';
            $fields['role'] = 'student';
        }

        $user = User::create($fields);

        $token = $user->createToken($request->name)->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,student,instructor'
        ]);

        $user = User::where(['email' => $fields['email']])->first();

        if ($fields['role'] == 'student' && $user->login_as === 'instructor') {

            return response()->json([
                'errors' => [
                    'email' => ['You are not allowed to login as student, your are instructor.']
                ]
            ], 401);
        }


        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'errors' => [
                    'email' => ['The provided credentials are incorrect.']
                ]
            ], 401);
        }

        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ], 200);
    }


    public function loginAdmin(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'errors' => [
                    'email' => ['The provided credentials are incorrect.']
                ]
            ], 401);
        }

        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
}

?>

<!-- create routes in api.php -->

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/admin/login', [AuthController::class, 'loginAdmin']);
