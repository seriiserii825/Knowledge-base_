<script setup lang="ts">
import { ROUTE_LIST, type RouteItemWithId } from "~/data/app_urls";

const emits = defineEmits(["emit_close"]);
const inputRef = ref<HTMLInputElement | null>(null);

const filtered_routes = ref<RouteItemWithId[]>([...ROUTE_LIST]);

const activeIndex = ref(0);

function onInput(event: Event) {
  const target = event.target as HTMLInputElement;
  const query = target.value.toLowerCase();

  filtered_routes.value = ROUTE_LIST.filter((route) => route.label.toLowerCase().includes(query));
  activeIndex.value = 0;
}

function handleKeydown(event: KeyboardEvent) {
  if (event.key === "Escape") {
    closePopup();
  }

  if (event.key === "ArrowDown") {
    event.preventDefault();
    if (activeIndex.value < filtered_routes.value.length - 1) {
      activeIndex.value++;
    }
  }

  if (event.key === "ArrowUp") {
    event.preventDefault();
    if (activeIndex.value > 0) {
      activeIndex.value--;
    }
  }

  if (event.key === "Enter") {
    event.preventDefault();
    const route = filtered_routes.value[activeIndex.value];
    if (route) {
      liClick(route.id);
    }
  }
}

function closePopup() {
  emits("emit_close");
}

function liClick(id: number) {
  const route = ROUTE_LIST.find((route) => route.id === id);
  console.log(route, "route");
}

onMounted(() => {
  inputRef.value?.focus();

  document.addEventListener("keydown", handleKeydown);
});
</script>

<template>
  <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="absolute left-0 top-0 z-10 h-full w-full bg-black/40" @click="closePopup"></div>
    <div class="z-20 w-full max-w-md rounded-xl bg-white shadow-xl">
      <!-- Search -->
      <div class="border-b p-4">
        <input
          ref="inputRef"
          type="text"
          placeholder="Search components..."
          class="w-full rounded-lg border px-4 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
          @input="onInput" />
      </div>

      <!-- List -->
      <ul v-if="filtered_routes.length" class="max-h-64 overflow-y-auto p-2">
        <li
          v-for="(item, index) in filtered_routes"
          :key="item.id"
          class="cursor-pointer rounded-md px-4 py-2 text-sm hover:bg-gray-100"
          :class="{
            'bg-blue-100 text-blue-700': index === activeIndex,
            'hover:bg-gray-100': index !== activeIndex,
          }"
          @click="liClick(item.id)">
          {{ item.label }} /({{ item.id }})
        </li>
      </ul>
    </div>
  </div>
</template>
