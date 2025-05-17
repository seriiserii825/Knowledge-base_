<?php 
// config/auth.php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'admin' => [
        'driver' => 'sanctum',
        'provider' => 'admins',
    ],
],
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => env('AUTH_MODEL', App\Models\User::class),
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => env('AUTH_ADMIN_MODEL', App\Models\Admin::class),
    ],

    'users' => [
        'driver' => 'database',
        'table' => 'users',
    ],
],

// config/sanctum.php
'stateful' => [

],

// app.php
->withMiddleware(function (Middleware $middleware) {
    // $middleware->api(prepend: [
    //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    // ]);

    $middleware->alias([
        'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
    ]);

    //
})

// api.php
Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', [AdminController::class, 'login']);
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('/logout', [AdminController::class, 'logout']);
    });
});
// modela Admin.php

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guard = 'admin';
    protected $guarded = [
        'id',
        'remember_token',
        'created_at',
        'updated_at',
    ];


// app/Http/Controllers/AdminController.php

class AdminController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        $user = Admin::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'status' => 'Login successful',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}
//frontend
// axiosInstance

const axiosInstance = axios.create({
  baseURL: "http://localhost:8080/api",
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
});

// Add a request interceptor to set the token dynamically
axiosInstance.interceptors.request.use(
  (config) => {
    if (process.client) {
      const token = localStorage.getItem("token");
      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }
    }
    return config;
  },
  (error) => Promise.reject(error)
);

export { axiosInstance };

// login

async function onSubmit(){
  try {
    const response = await axiosInstance.post("/admin/login", form.value);
    console.log(response);
    localStorage.setItem("token", response.data.token);
    const cookie_user = useCookie("user");
    cookie_user.value = JSON.stringify(response.data.user);
    user_store.setUser(response.data.user);
    router.push('/admin/dashboard');
    useSweetAlert('success', 'Login successful', 'You have successfully logged in');
  } catch (error) {
    handleAxiosError(error);
  }
}

// logout

async function logout(){
  try {
    await axiosInstance.post("/admin/logout");
    localStorage.removeItem("token");
    const cookie_user = useCookie("user");
    cookie_user.value = null;
    user_store.setUser(null);
    useSweetAlert('success', 'Logout successful', 'You have successfully logged out');
    router.push('/admin/login');
  } catch (error) {
    
  }
}
?>
