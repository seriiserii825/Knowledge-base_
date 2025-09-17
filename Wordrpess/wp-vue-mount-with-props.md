# mount with props

vue-functions.php
```php
<?php
add_shortcode('custom-gallery', 'customGallery');

function customGallery($atts, $content = null)
{
  return "<div id='customGallery'></div>";
}

add_shortcode('custom-gallery-2', 'customGallery2');

function customGallery2($atts, $content = null)
{
  return "<div id='customGallery2' data-acf='custom_slider_2'></div>";
}

add_shortcode('our-rooms', 'ourRooms');

function ourRooms($atts, $content = null)
{
  return "<div id='ourRooms'></div>";
}
```

vue-app.ts
```ts

import { createApp } from "vue";
import CustomGalleryView from "./views/CustomGalleryView.vue";
import OurRoomsSliderView from "./views/OurRoomsSliderView.vue";
createVueApp("#customGallery", CustomGalleryView);
mountWithProps("#customGallery2", CustomGalleryView);
createVueApp("#ourRooms", OurRoomsSliderView);

//@ts-ignore
function createVueApp(id: string, component) {
  if (document.querySelector(id)) {
    const app = createApp(component);
    app.mount(id);
  }
}

function mountWithProps(selector: string, component: any) {
  const el = document.querySelector<HTMLElement>(selector);
  if (!el) return;

  // everything on data-* becomes a string prop
  const props = {
    // e.g. data-shortcode, data-acf → { shortcode: "...", acf: "..." }
    ...el.dataset,
    // you can also pass the element id if you want
    targetId: el.id,
  };

  // createApp(Component, props) passes initial props to the root
  createApp(component, props).mount(el);
}
```

inside vue component
```vue

const props = defineProps({
  acf: {
    type: String,
    required: false,
    default: "",
  },
});
```
