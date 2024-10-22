<template>
  <div>
    <h3>Drag and Drop Order Items</h3>
    <ul>
      <li
        v-for="(item, index) in items"
        :key="item.id"
        draggable="true"
        @dragstart="onDragStart(index)"
        @dragover.prevent="onDragOver"
        @drop="onDrop(index)"
        class="draggable-item"
      >
        {{ item.name }}
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

const items = ref([
  { id: 1, name: "Item 1" },
  { id: 2, name: "Item 2" },
  { id: 3, name: "Item 3" },
  { id: 4, name: "Item 4" },
]);

let draggedIndex = ref(null);

const onDragStart = (index: number) => {
  console.log("Drag started:", index);
  draggedIndex.value = index;
};

const onDragOver = (event: DragEvent) => {
  console.log("Dragging over an element");
  event.preventDefault(); // Must call preventDefault() to allow drop
};

const onDrop = (index: number) => {
  console.log("Dropped on index:", index);
  const draggedItem = items.value[draggedIndex.value];
  // Reorder the list
  items.value.splice(draggedIndex.value, 1); // Remove dragged item
  items.value.splice(index, 0, draggedItem); // Insert at new position
  draggedIndex.value = null; // Reset dragged index
};
</script>

<style>
.draggable-item {
  padding: 10px;
  margin: 5px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  cursor: move;
}
</style>
