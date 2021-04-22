<style>
v-enter-from - стартовое значение
v-enter-active  - плавность
v-enter-to - финальное значение
v-leave-from
v-leave-active
v-leave-to
</style>
// Все 6 классов нужно, когда используется transition
Если исользозвать animation, нужны всего лишь 2 класса
key - атрибут, если нужно анимировать элементы, которые находятся раядом.

Class:
enter-class
enter-active-class
enter-to-class (в версии 2.1.8+)
leave-class
leave-active-class
leave-to-class (в версии 2.1.8+)

mode:
in-out: Сначала появляется новый элемент, и только после этого исчезает старый.
out-in: Сначала исчезает старый элемент, и только после этого появляется новый.

Длительность :duration="{ enter: 500, leave: 800 }"

Group
appear
transition tag="ul" name="list"
.list-enter
.list-leave
.list-move {
        transition: all .5s ease;
}



<style>
.fade-enter-active {
  animation: fadeIn 1s ease;
}
.fade-leave-active {
  animation: fadeIn 1s ease;
}
@keyframes fadeIn {
  0% {
    opacity: 0; 
  }
  100% {
    opacity: 1;
  }
}
@keyframes fadeOut {
  0% {
    opacity: 1; 
  }
  100% {
    opacity: 0;
  }
}
</style>
