<style>
.bounce-enter-active {
  animation: bounce-in 0.5s;
}

.bounce-leave-active {
  animation: bounce-in 0.5s reverse;
}

@keyframes bounce-in {
  0% {
    transform: scale(0);
  }

  50% {
    transform: scale(1.25);
  }

  100% {
    transform: scale(1);
  }
}

.popup-enter-active {
  transition: opacity 0.5s ease;
}

.popup-leave-active {
  transition: opacity 0.5s ease;
}

.popup-enter-from {
  opacity: 0;
}

.popup-leave-to {
  opacity: 0;
}
</style>

