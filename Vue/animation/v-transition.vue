<template>
  <transition name="popup">
    <VueAgentsPopup
                    :site-url="siteUrl"
                    v-if="is_popup_visible"
                    :item="agent"
                    @close-popup="closePopup" />
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

.item-enter-active {
  animation: fadeIn 0.5s;
}

.item-leave-active {
  animation: fadeOut 0.5s;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

@keyframes fadeOut {
  from {
    opacity: 1;
  }

  to {
    opacity: 0;
  }
}
</style>

