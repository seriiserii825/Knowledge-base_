### component

### composable
```js

import { onBeforeUnmount, onMounted } from "vue";
export default function useDetectOutsideClick(component: any, callback: any) {
  if (!component) return;
  const listener = (event: Event) => {
    if (
      event.target !== component.value &&
      event.composedPath().includes(component.value)
    ) {
      return;
    }
    if (typeof callback === "function") {
      callback();
    }
  };
  onMounted(() => {
    window.addEventListener("click", listener);
  });
  onBeforeUnmount(() => {
    window.removeEventListener("click", listener);
  });

  return { listener };
}
```

```js
const first_click = ref(false);
function closePopup() {
  second_store.active_allergents = [];
}
useDetectOutsideClick(componentRef, () => {
  console.log(first_click.value, "first_click.value");
  if (second_store.active_allergents.length && first_click.value) {
    closePopup();
  }
  first_click.value = true;
});
```

### html

````html
<header class="alergenti-popup__header">
  <h2 class="alergenti-popup__title">Allergeni</h2>
  <div class="alergenti-popup__close" @click="closePopup">
    <IPopupClose />
  </div>
</header>
<div ref="componentRef" class="alergenti-popup__body alergenti-scrollbar">
</div>
````
