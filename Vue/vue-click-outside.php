<script setup>
import {ref} from 'vue'

const elementRef = ref(null)
    
window.addEventListener('click', (event) => {
    if (!elementRef.value.contains(event.target)){
        console.log('click outside element')
    }
})

</script>


<template>
  <div ref="elementRef">your element</div>
</template>
