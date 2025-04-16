<script setup>
import { ref, onMounted, onBeforeUnmount, nextTick, watch } from 'vue'

const items = [
  { label: 'Home' },
  { label: 'About' },
  { label: 'Services' },
  { label: 'Portfolio' },
  { label: 'Blog' },
  { label: 'Contact' },
  { label: 'Careers' },
]
const show_dropdown = ref(false)
const visibleItems = ref([])
const hiddenItems = ref([])

const menuWrapper = ref(null)
const menu = ref(null)
const measureRef = ref(null)

const recalculateMenu = () => {
  if (!measureRef.value || !menuWrapper.value) return

  const totalWidth = menuWrapper.value.clientWidth
  const buttons = Array.from(measureRef.value.children)

  let currentWidth = 0
  const fits = []
  const hidden = []

  for (const btn of buttons) {
    const btnWidth = btn.offsetWidth
    if (currentWidth + btnWidth <= totalWidth - 80) {
      fits.push(btn.textContent.trim())
      currentWidth += btnWidth
    } else {
      hidden.push(btn.textContent.trim())
    }
  }

  visibleItems.value = items.filter(i => fits.includes(i.label))
  hiddenItems.value = items.filter(i => hidden.includes(i.label))
}

const handleResize = () => {
  nextTick(recalculateMenu)
}

onMounted(() => {
  window.addEventListener('resize', handleResize)
  nextTick(() => recalculateMenu())
})

onBeforeUnmount(() => {
  window.removeEventListener('resize', handleResize)
})
</script>
<template>
  <div ref="menuWrapper" class="menu-wrapper">
    <div ref="menu" class="menu">
      <template v-for="(item, index) in visibleItems" :key="item.label">
        <button class="menu-item">{{ item.label }}</button>
      </template>

      <div v-if="hiddenItems.length" class="dropdown" ref="dropdownRef">
        <button @click="show_dropdown = !show_dropdown" class="menu-item">More ▾</button>
        <div class="dropdown-content" v-if="show_dropdown">
          <button v-for="item in hiddenItems" :key="item.label" class="menu-item">
            {{ item.label }}
          </button>
        </div>
      </div>
    </div>

    <!-- Invisible measuring container -->
    <div ref="measureRef" class="menu measure">
      <template v-for="item in items" :key="item.label">
        <button class="menu-item">{{ item.label }}</button>
      </template>
    </div>
  </div>
</template>
<style scoped>
.menu-wrapper {
  width: 100%;
  border: 1px solid #ccc;
  padding: 8px;
  box-sizing: border-box;
  position: relative;
}

.menu {
  display: flex;
  gap: 8px;
  flex-wrap: nowrap;
  align-items: center;
}

.menu-item {
  padding: 8px 12px;
  white-space: nowrap;
  background: #f0f0f0;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
}

.dropdown-content {
  position: absolute;
  top: 100%;
  right: 0;
  background: white;
  border: 1px solid #ccc;
  min-width: 120px;
  z-index: 10;
  display: flex;
  flex-direction: column;
}

.dropdown-content .menu-item {
  width: 100%;
}

.measure {
  visibility: hidden;
  position: absolute;
  top: -9999px;
  left: -9999px;
}
</style>
