#================ main.js
<script charset="utf-8">
import ColorDirective from "./directives/color";
Vue.directive("color", ColorDirective);
</script>

#================== App.vue
<template>
  <div id="app">
    <Car>
      <h2 v-color:color.delay="'red'" slot="title" v-if="visible">
        {{ carName }}
      </h2>
      <p slot="text">Lorem ipsum dolor.</p>
    </Car>
  </div>
</template>

#================ color.js
<script charset="utf-8">
export default {
  // вызывается когда директива инициализируется
  /**
   *
   * @param el, тот елемент к которому будет привязанна директива
   * @param bindings, все необходимые свойства которые будет передавать внутрь директивы
   * @param vnode, объект виртуального дерева, где будет хранится директива
   * bindings и vnode можно только читать
   */
  bind(el, bindings) {
    const delayModifier = bindings.modifiers["delay"];

    if (delayModifier) {
      setTimeout(() => {
        const arg = bindings.arg ? bindings.arg : "color";
        el.style[arg] = bindings.value;
      }, 2000);
    } else {
      // arg v-color:color, v-color:background
      const arg = bindings.arg ? bindings.arg : "color";
      el.style[arg] = bindings.value;
    }

    // возвращает true / false
    const fontModifier = bindings.modifiers["font"];
    if (fontModifier) {
      el.style.fontSize = "40px";
    }
  },
  inserted() {},
  updated() {},
  componentUpdated() {},
  unbind() {},
};
</script>
