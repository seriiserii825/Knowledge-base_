<?php 
// auth.php

'passwords' => [
  'users' => [
      'provider' => 'users',
      'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
      'expire' => 60,
      'throttle' => 60,
  ],
  'admins' => [
      'provider' => 'admins',
      'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
      'expire' => 60,
      'throttle' => 60,
  ],
],

// create post 
Route::post('/forgot-password', [AdminController::class, 'forgotPassword']);

// AdminController.php

public function forgotPassword(Request $request): JsonResponse
{

    $request->validate([
        'email' => ['required', 'email'],
    ]);

    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    // $status = Password::sendResetLink(
    //     $request->only('email')
    // );

    $status = Password::broker('admins')->sendResetLink(
        $request->only('email')
    );

    if ($status != Password::RESET_LINK_SENT) {
        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }

    return response()->json(['status' => __($status)]);
}

// in Mailtrap get link, in vue create page and get token and email
?>
