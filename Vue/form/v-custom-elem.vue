<template>
  <div class="on-off">
    <button
        class="on"
        :class="{'active': value}"
    >On
    </button>
    <button
        class="off"
        :class="{'active': !value}"
    >Off
    </button>
  </div>
</template>

<script>
export default {
  props: ['value']
}
</script>

<style>
.on-off {
  display: flex;
  justify-content: center;
  align-items: center;
}
button {
  border: none;
  padding: 1.5rem 2.5rem;
  cursor: pointer;
  margin-right: 2rem;
  outline: none;
}
button:active {
  box-shadow: inset 2px 2px 4px rgba(0, 0, 0, .5);
}
.on.active {
  background: green;
  color: #fff;
}
.off.active {
  background: red;
  color: #fff;
}
</style>
