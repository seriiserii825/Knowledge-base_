#==================== App
<template>
  <div id="app">
    <Car>
      <h2 slot="title">{{ carName }}</h2>
      <p slot="text">Lorem ipsum dolor.</p>
    </Car>
  </div>
</template>

#========================= Car
<template>
  <div>
    <slot name="title"></slot>
    <hr>
    <slot name="text"></slot>
  </div>
</template>
