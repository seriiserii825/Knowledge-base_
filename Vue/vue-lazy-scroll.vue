<script setup>
import { onMounted, onUnmounted, ref } from "vue";

const posts_per_page = 6;
const displayed_count = ref(6);
const has_more = ref(true);
const is_loading_more = ref(false);
const container_ref = ref(null);

// Mock data - replace with your actual data
const all_posts = ref(
  Array.from({ length: 50 }, (_, i) => ({
    id: i + 1,
    title: `Post ${i + 1}`,
  })),
);

const visible_posts = ref([]);

function loadMore() {
  if (!has_more.value || is_loading_more.value) return;

  is_loading_more.value = true;

  setTimeout(() => {
    displayed_count.value += posts_per_page;
    visible_posts.value = all_posts.value.slice(0, displayed_count.value);
    has_more.value = all_posts.value.length > displayed_count.value;
    is_loading_more.value = false;
  }, 300);
}

function handleScroll() {
  if (!container_ref.value) return;

  const el = container_ref.value;
  const scrolled = window.scrollY + window.innerHeight - el.offsetTop;

  if (scrolled >= el.scrollHeight - 200) {
    loadMore();
  }
}

onMounted(() => {
  visible_posts.value = all_posts.value.slice(0, posts_per_page);
  has_more.value = all_posts.value.length > posts_per_page;
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<template>
  <div ref="container_ref" class="posts-container">
    <div v-for="post in visible_posts" :key="post.id" class="post">
      {{ post.title }}
    </div>

    <div v-if="is_loading_more" class="loading">Loading...</div>
    <div v-if="!has_more && visible_posts.length" class="end">End of posts</div>
  </div>
</template>

<style scoped>
.posts-container {
  padding: 20px;
}
.post {
  padding: 20px;
  margin: 10px 0;
  border: 1px solid #ddd;
}
.loading,
.end {
  text-align: center;
  padding: 20px;
}
</style>
