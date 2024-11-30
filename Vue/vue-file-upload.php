<template>
  <div>
    <input
      type="file"
      @change="onFileChanged($event)"
      accept="image/*"
      capture />
  </div>
</template>
<script setup lang="ts">
  import {
    ref
  } from "vue";
  const file = ref < File | null > ();

  function onFileChanged($event: Event) {
    const target = $event.target as HTMLInputElement;
    if (target && target.files) {
      file.value = target.files[0];
    }
  }

  async function saveImage() {
    if (file.value) {
      try {

        form_data.set("company_logo", file.value as File);
        await apiJobStore(form_data, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        // save file.value
      } catch (error) {
        console.error(error);
        form.value?.reset();
        file.value = null;
      } finally {}
    }
  }
</script>

<?php
// storeRequest
$rules = [
  'company_logo' => 'nullable|file|image',
];

// !!!! important, php artisan storage:link

// controller
function store(StoreRequest $request)
{
  $user = User::first();
  $result = $request->validated();
  $result['user_id'] = $user->id;
  if ($request->hasFile('company_logo')) {
    $result['company_logo'] = $request->file('company_logo')->store('logos', 'public');
  }
  try {
    $job = Job::create($result);
    return new JobResource($job);
  } catch (\Throwable $th) {
    return response()->json([
      'message' => 'Error creating job listing',
      'error' => $th->getMessage()
    ], 500);
  }
}
?>
