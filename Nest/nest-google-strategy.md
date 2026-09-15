# Google OAuth Strategy Setup

## 1. Open Google Cloud Console

```text
https://console.cloud.google.com/welcome?pli=1
```

## 2. Create a Project

1. Click the **project selector** near the Google Cloud logo.
2. Click **New Project**.
3. Enter a project name.
4. Click **Create**.
5. Select the newly created project.

## 3. Configure OAuth Consent Screen

Go to:

**APIs & Services → OAuth consent screen**

Click **Get Started**.

Fill in the application information:

```text
App name: TeaShop Angular
User support email: your email
```

Complete all the required steps and finish the OAuth consent screen configuration.

## 4. Create OAuth Credentials

Go to:

**APIs & Services → Credentials**

At the top, click:

**Create Credentials → OAuth client ID**

Select:

```text
Application type: Web application
```

## 5. Configure URLs

### Authorized JavaScript origins

```text
http://localhost:5000
```

### Authorized redirect URIs

```text
http://localhost:5000/auth/google/callback
```

Click **Create**.

## 6. Add Credentials to `.env`

Copy the generated **Client ID** and **Client Secret** and add them to your `.env` file:

```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
```

Example:

```env
GOOGLE_CLIENT_ID=123456789-example.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your_secret_here
```

> Do not commit the `.env` file to Git.
