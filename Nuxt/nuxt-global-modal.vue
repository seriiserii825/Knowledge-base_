// app.vue
<script setup lang="ts">
const modalRef = ref(null);

const openModal = (component, props = {}) => {
  modalRef.value?.openModal(component, props);
};

provide("openModal", openModal);
</script>
<template>
  <NuxtLayout>
    <NuxtPage />
    <PopupModal ref="modalRef" />
  </NuxtLayout>
</template>

// PopupModal.vue

<script setup lang="ts">
import { ref, shallowRef, defineExpose } from "vue";

const isOpen = ref(false);
const modalContent = shallowRef(null);
const modalProps = ref({});

const openModal = (component, props = {}) => {
  modalContent.value = component;
  modalProps.value = props;
  isOpen.value = true;
};

const closeModal = () => {
  isOpen.value = false;
};

defineExpose({ openModal, closeModal });
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}
.modal-header {
  display: flex;
  justify-content: flex-end;
}
.modal-content {
  background: white;
  padding: 20px;
  border-radius: 10px;
  max-width: 500px;
  width: 100%;
  position: relative;
}
.close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
<template>
  <Teleport to="body">
    <Transition name="fade">
      <div v-if="isOpen" class="modal-overlay" @click="closeModal">
        <div class="modal-content" @click.stop>
          <div class="modal-header">
            <button
              @click="closeModal"
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <component :is="modalContent" v-bind="modalProps" />
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

// ExampleComponent.vue
<script setup lang="ts">
import { inject } from "vue";

const openModal = inject("openModal");
import ModalContent from "./CreateChapter.vue";

const showModal = () => {
  openModal(ModalContent, { message: "Hello from modal!" });
};
</script>
<template>
  <button class="common_btn" @click="showModal">Add New Chapter</button>
</template>

// CreateChapter.vue

<script setup lang="ts">
const name = ref<string>("");
const errors = ref({
  name: [],
});
</script>

<template>
  <div class="chapter">
    <InputComponent
      label="Chapter Name"
      v-model:value="name"
      type="text"
      name="name"
      :errors="errors ? errors.name : []"
    />
  </div>
</template>
