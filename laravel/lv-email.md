## create config file

```php

/config/mail_queue.php

return [
'is_queue' => env('MAIL_QUEUE', false),
];

.env
MAIL_QUEUE=true

```

## config for site_url

```php
config/site_settings.php
return [
'site_url' => env('SITE_URL', 'http://localhost:3000'),
];
```

## create Email class

```php
make:mail InstructorRequestEmail

// app/Mail/InstructorRequestEmail.php
public function content(): Content
{
return new Content(
    view: 'mail.instructor-request-email.blade.php',
    with: [
        'site_url' => config('site_settings.site_url'),
    ],
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

https://github.com/leemunroe/responsive-html-email-template/blob/master/email.html

```php
views/mail/instructor-request-email.blade.php
mail body
<p>Visit your dashboard <a href="{{ $site_url }}/instructor/dashboard"
        target="_blank">Instructor Dashboard</a></p>
```

## request controller after update

```php
.env
MAIL_QUEUE=true

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

    if (config('mail_queue.is_queue')) {
        Mail::to($user->email)->queue(new InstructorRequestEmail($user));
    } else {
        Mail::to($user->email)->send(new InstructorRequestEmail($user));
    }
    return response()->json($user, 200);
}

```

mail was queue in jobs table
to send mail

```php
php artisan queue:work
```

or set MAIL_QUEUE to false in .env file to send mail directly
