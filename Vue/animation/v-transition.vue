<template>
  <transition name="popup">
    <VueAgentsPopup
      :site-url="siteUrl"
      v-if="is_popup_visible"
      :item="agent"
      @close-popup="closePopup"
    />
  </transition>
</template>
<style type="text/css" media="screen">
/* // when popup start or end */
.popup-enter-active,
.popup-leave-active {
  transition: all 0.5s;
}
/* // when popup work */
.popup-enter,
.popup-leave-to {
  opacity: 0;
  transform: scale(1.1);
}
</style>

