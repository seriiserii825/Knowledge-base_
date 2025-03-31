## create config file

```php

/config/mail_queue.php

return [
'is_queue' => env('MAIL_QUEUE', false),
];

.env
MAIL_QUEUE=true

```

## create Email class

```php
make:mail InstructorRequestEmail

// app/Mail/InstructorRequestEmail.php
public function content(): Content
{
return new Content(
view: 'mail.instructor-request-email.blade.php',
);
}

public function envelope(): Envelope
{
return new Envelope(
subject: 'Instructor has been approved',
);
}
```

## create view

```php
views/mail/instructor-request-email.blade.php
mail body
<h2>Instructor approved</h2>
```

## request controller after update

```php


public function update(Request $request, User $user)
{
    $request->validate([
        'approve_status' => 'required|in:initial,pending,approved,rejected',
    ]);
    if ($request->approve_status === 'approved') {
        $user->role = 'instructor';
    }
    $user->approve_status = $request->approve_status;
    $user->save();
    return response()->json($user, 200);
}
```
