<script>
// nuxt plugin fetch.ts
import { createAuthRepository } from "~/repository/createAuthRepository";
import { createPostsRepository } from "~/repository/createPostsRepository";

export default defineNuxtPlugin({
  name: "fetch",
  parallel: true,
  setup(nuxtApp) {
    const auth_store = useAuthStore();
    const token = auth_store.token;

    const config = useRuntimeConfig();

    const fetchApi = $fetch.create({
      baseURL: config.public.apiBase,
      onRequest({ request, options, error }) {
        options.headers.set("Content-type", "application/json");
        options.headers.set("Accept", "application/json");
        options.headers.set("Authorization", "Bearer " + token);
        // options.headers.set("Authorization", "Bearer " + "mynewtoken");
      },
      async onResponseError({ response }) {
        // if (response.status === 401) {
        //   await nuxtApp.runWithContext(() => navigateTo("/login"));
        // }
      },
    });

    const api = {
      auth: createAuthRepository(fetchApi),
      posts: createPostsRepository(fetchApi),
    };

    // Expose to useNuxtApp().$api
    return {
      provide: {
        fetchApi,
        api,
      },
    };
  },
});

// repository/createPostsRepository.ts
import type { TPost } from "~/types/TPost";
import type { TPostStore } from "~/types/TPostStore";

export function createPostsRepository(appFetch: typeof $fetch) {
  return {
    all() {
      return appFetch<TPost[]>("/posts");
    },
    one(id: string | number) {
      return appFetch<TPost>(`/posts/${id}`);
    },
    add(body: TPostStore) {
      return appFetch("/posts", {
        method: "POST",
        body: JSON.stringify(body),
      });
    },
  };
}
</script>

<script setup lang="ts">
// pages/index.vue
const { error, pending, data } = await useAsyncData("posts", () => useNuxtApp().$api.posts.all());
</script>

<template>
  <!-- Posts List -->
  <main class="container mx-auto px-6 py-6">
    <header class="mb-8">
      <NuxtLink
        to="/posts/create"
        class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
        Create New Post
      </NuxtLink>
    </header>
    <h2 v-if="pending">Loading: {{ pending }}</h2>
    <div v-else-if="error" class="text-red-600">Error: {{ error.message }}</div>
    <div v-else-if="data">
      <PostItem v-for="post in data" :key="post.id" :post="post" />
    </div>
    <div v-else>No posts available.</div>
  </main>

  <!-- Footer -->
</template>

<script setup lang="ts">
// pages/posts/create.vue
import type { TPostStore } from "~/types/TPostStore";

definePageMeta({
  middleware: ["auth"],
});
const form = ref<TPostStore>({
  title: "",
  url: "",
  content: "",
});

watch(
  () => form.value.title,
  (newTitle) => {
    form.value.url = newTitle
      .toLowerCase()
      .replace(/[^a-z0-9]+/g, "-")
      .replace(/(^-|-$)+/g, "");
  }
);

async function onSubmit() {
  try {
    const response = await useNuxtApp().$api.posts.add(form.value);
    console.log(response, "response");
    navigateTo("/posts");
  } catch (error) {
    useSweetAlert("error", "Could not create post", error.message);
    console.error("Create post error", error);
  }
}
</script>
