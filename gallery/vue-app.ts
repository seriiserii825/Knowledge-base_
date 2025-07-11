import {createApp} from "vue";
import GalleryView from "./views/GalleryView.vue";
createVueApp("#gallery-view", GalleryView);

function createVueApp(id: string, component) {
    if (document.querySelector(id)) {
        const app = createApp(component);
        app.mount(id);
    }
}
