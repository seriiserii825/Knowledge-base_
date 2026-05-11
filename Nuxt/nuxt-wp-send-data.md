### nuxt

/home/serii/Documents/nuxt/nuxt-digital-menu/plugins/iframe-height.client.ts

```typescript
import { watch } from "vue";
import { useHomeStore } from "~/store/useHomeStore";

export default defineNuxtPlugin((nuxtApp) => {
  const sendScrollTop = () => {
    window.parent.postMessage({ type: "NUXT_IFRAME_SCROLL_TOP" }, "*");
  };

  const sendHeight = () => {
    const height = document.documentElement.scrollHeight;
    window.parent.postMessage({ type: "NUXT_IFRAME_HEIGHT", height }, "*");
  };

  nuxtApp.hook("app:mounted", () => {
    // ResizeObserver fires whenever page height changes — handles API data + images
    let debounceTimer: ReturnType<typeof setTimeout>;
    const observer = new ResizeObserver(() => {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(sendHeight, 100);
    });
    observer.observe(document.body);

    const home_store = useHomeStore();
    watch(
      () => home_store.current_level,
      () => {
        sendScrollTop();
      },
    );
  });
});
```

### wordpress

```typescript
const IFRAME_HEIGHT_FALLBACK = 1800;

export default function singleProductIframe(): void {
  const wrapper = document.querySelector<HTMLElement>(".iframe-scroll");
  const iframe = wrapper?.querySelector<HTMLIFrameElement>("iframe");

  if (!wrapper || !iframe) return;

  iframe.style.height = `${IFRAME_HEIGHT_FALLBACK}px`;

  // Fit the wrapper to the remaining viewport height
  function fit(): void {
    if (!wrapper) return;

    const top = wrapper.getBoundingClientRect().top;
    const paddingBottom = 0;
    wrapper.style.height = `${window.innerHeight - top - paddingBottom}px`;
  }

  // Full-page reload inside the iframe
  iframe.addEventListener("load", () => {
    wrapper.scrollTop = 0;
  });

  // SPA navigation inside the iframe (Nuxt postMessage)
  window.addEventListener("message", (event) => {
    if (event.data?.type === "NUXT_IFRAME_SCROLL_TOP") {
      wrapper.scrollTop = 0;
    }
    // console.log('Received message from iframe:', event.data.height);
    if (event.data?.type === "NUXT_IFRAME_HEIGHT" && typeof event.data.height === "number") {
      iframe.style.height = `${event.data.height}px`;
    }
  });

  fit();
  window.addEventListener("resize", fit, { passive: true });
}
```
