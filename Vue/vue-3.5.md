## defineModel() — Vue 3.4

```vue
<script setup lang="ts">
  const model = defineModel<string>();
</script>

<template>
  <input v-model="model" />
</template>
```

---

## Reactive Props Destructure — Vue 3.5

```vue
<script setup lang="ts">
  const { title = "Default title", count = 0 } = defineProps<{
    title?: string;
    count?: number;
  }>();
</script>

<template>
  <h2>{{ title }}</h2>
  <p>{{ count }}</p>
</template>
```

---

## onWatcherCleanup() — Vue 3.5

```vue
<script setup lang="ts">
  import { ref, watch, onWatcherCleanup } from "vue";

  const userId = ref(1);
  const user = ref(null);

  watch(userId, async (id) => {
    const controller = new AbortController();

    onWatcherCleanup(() => {
      controller.abort();
    });

    const response = await fetch(`/api/users/${id}`, {
      signal: controller.signal,
    });

    user.value = await response.json();
  });
</script>
```

---

## useId() — Vue 3.5

```vue
<script setup lang="ts">
  import { useId } from "vue";

  const id = useId();
</script>

<template>
  <label :for="id">Email</label>
  <input :id="id" type="email" />
</template>
```

---

## useTemplateRef() — Vue 3.5

```vue
<script setup lang="ts">
  import { onMounted, useTemplateRef } from "vue";

  const input = useTemplateRef<HTMLInputElement>("input");

  onMounted(() => {
    input.value?.focus();
  });
</script>

<template>
  <input ref="input" />
</template>
```
