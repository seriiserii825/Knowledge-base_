<script setup>
import { onBeforeUnmount, onMounted } from "vue";

export default function useDetectOutsideClick(component, callback) {
    if (!component) return;
    const listener = (event) => {
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
</script>

//Select component
<script>
import useDetectOutsideClick from "../../composables/useDetectOutsideClick";

const selectRef = ref(null);
useDetectOutsideClick(selectRef, () => {
    is_visible_options.value = false;
});
</script>
<template>
<div class="select-component" ref="selectRef"> </div>
</template>
