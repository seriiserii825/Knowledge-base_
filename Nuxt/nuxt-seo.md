### nuxt config title and meta description example

```typescript
  runtimeConfig: {
    public: {
      baseUrl: process.env.NUXT_PUBLIC_BASE_URL || 'http://localhost:3000',
    },
  },
  app: {
    head: {
      title: 'Sondaggio comunicazione | Rewind e Altuofianco', // default fallback title
      meta: [
        {
          name: 'description',
          content:
            "Il sondaggio ha l'obiettivo di analizzare in modo chiaro e completo come funzionano oggi le comunicazioni nella nostra azienda.",
        },
        { name: 'robots', content: 'index, follow' },
      ],
      htmlAttrs: {
        lang: 'it',
      },
      link: [
        { rel: 'stylesheet', href: '/css/fonts.css' },
        { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      ],
    },
    pageTransition: { name: 'page', mode: 'out-in' },
    layoutTransition: { name: 'layout', mode: 'out-in' },
  },
```

### plugin for cannonical url

plugins/canonical.ts

```typescript
// plugins/canonical.ts
export default defineNuxtPlugin(() => {
  const route = useRoute();
  const config = useRuntimeConfig();

  // Автоматически добавляет canonical на каждую страницу
  useHead({
    link: [
      {
        rel: "canonical",
        href: computed(() => `${config.public.baseUrl}${route.path}`),
      },
    ],
  });
});
```

### for every page

```typescript
// composables/useSeo.ts
export const useSeo = (options?: {
  title?: string;
  description?: string;
  robots?: string;
  ogImage?: string;
}) => {
  const route = useRoute();
  const config = useRuntimeConfig();

  const canonicalUrl = `${config.public.baseUrl}${route.path}`;

  useSeoMeta({
    title: options?.title,
    description: options?.description,
    robots: options?.robots || "index, follow",
    ogTitle: options?.title,
    ogDescription: options?.description,
    ogUrl: canonicalUrl,
    ogImage: options?.ogImage,
    twitterCard: "summary_large_image",
  });

  useHead({
    link: [
      {
        rel: "canonical",
        href: canonicalUrl,
      },
    ],
  });
};
```

### usage on the page

```vue
<script setup lang="ts">
const department = ref({
  title: "Sondaggio comunicazione | Rewind e Altuofianco",
  description: "Il sondaggio ha l'obiettivo...",
});

useSeo({
  title: department.value.title,
  description: department.value.description,
});
</script>
```
