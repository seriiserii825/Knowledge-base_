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

// artisan create email
make:mail ForgotPasswordMail

## in mail create 2 public vars $subject and $body
## pass vars to the constructor
## in function envelope pass $subject 
## in function content pass path to mail, admin.email and create this file
// ForgotPasswordMail

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject, $body;

    /**
     * Create a new subject instance.
     */
    public function __construct($subject, $body)
    {
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Get the subject envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.forgot-password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

// file forgot-password.blade.php
{!! $body !!}



// create post 
Route::post('/forgot-password', [AdminController::class, 'forgotPassword']);

// AdminController.php

public function forgotPassword(Request $request): JsonResponse
{
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $user = Admin::where('email', $request->email)->first();
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $token = Password::broker('admins')->createToken($user);
    $user->token = $token;
    $user->update();

    $url = 'http://localhost:3000/admin/reset-password/' . $token . '?email=' . $request->email;

    $subject = 'Reset Password Notification';
    $body = 'Click here to reset your password: <a href="' . $url . '">Reset Password</a>';
    Mail::to($request->email)->send(new ForgotPasswordMail($subject, $body));
    return response()->json([
        'status' => 'success',
        'message' => 'Password reset link sent to your email address.',
    ]);
}

// in Mailtrap get link, in vue create page and get token and email
?>
