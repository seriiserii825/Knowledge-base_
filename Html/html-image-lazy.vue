https://webperf-snippets.nucliweb.net/Interaction/Input-Latency-Breakdown
<template>
  <div ref="container_ref" class="my-slider">
    <div class="my-slider__wrap">
      <div v-for="(item, index) in slides" :key="index" class="my-slider__item">
        <img
          v-if="item.url"
          :src="item.url"
          :alt="item.alt"
          :loading="index < 2 ? 'eager' : 'lazy'"
          :fetchpriority="index === 0 ? 'high' : 'auto'"
          width="1280"
          height="800"
          class="estate-slider__img"
        />
      </div>
    </div>
  </div>
</template>
