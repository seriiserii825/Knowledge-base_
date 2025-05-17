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

//reset-password file
?>
<script setup lang="ts">
import { useRoute } from "vue-router";

const route = useRoute();
const router = useRouter();
const token = route.params.token;

const form = ref({
  email: route.query.email,
  token: token,
  password: "",
  password_confirmation: "",
});
const errors = ref({
  email: "",
  password: "",
  password_confirmation: "",
});

async function onSubmit(){
  try {
    await axiosInstance.post("/admin/reset-password", form.value);
    useSweetAlert('success', 'Password reset', 'Your password has been reset successfully');
    router.push('/admin/login');
  } catch (error) {
    handleAxiosError(error);
  }
}
</script>

<template>
  <div class="password-reset">
    <h2 class="text-center fw-bold">Reset Password</h2>
    <form @submit.prevent="onSubmit" class="m-auto w-50 pt-5">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input
          type="email"
          v-model="form.email"
          name="email"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp" />
        <span class="text-danger" v-if="errors.email">{{ errors.email }}</span>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input v-model="form.password" name="password" type="password" class="form-control" id="exampleInputPassword1" />
        <span class="text-danger" v-if="errors.password">{{ errors.password }}</span>
      </div>
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Password Confirmation</label>
        <input v-model="form.password_confirmation" name="password_confirmation" type="password" class="form-control" id="password_confirmation" />
        <span class="text-danger" v-if="errors.password">{{ errors.password_confirmation }}</span>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<?php 
// and method

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'confirmed', 'min:8'],
        'token' => ['required', 'string'],
    ]);

    $user = Admin::where('email', $request->email)->first();
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $response = Password::broker('admins')->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        }
    );

    if ($response == Password::PASSWORD_RESET) {
        return response()->json(['message' => 'Password reset successfully'], 200);
    } else {
        return response()->json(['message' => 'Failed to reset password'], 500);
    }
}

?>
