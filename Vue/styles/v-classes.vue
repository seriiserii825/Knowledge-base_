// Задаем классы с помощью объекта
<div class="circle" @click="isActive = !isActive" :class="{'red': isActive, 'blue': !isActive}"></div>

// Классы в массиве, будет работать приоритет. Если переменная color существует, то будет использована она.  
<div class="circle" @click="isActive = !isActive" :class="[color, {'red': isActive}]"></div>
<input type="text" v-model="color">

// Если используются слишком много условий для класса, то их можно вынести в отдельный метод computed
<div class="circle" @click="isActive = !isActive" :class="getCssClasses"></div>
<script charset="utf-8">
//computed
getCssClasses: function(){
  return {'red': this.isActive, 'blue': !this.isActive};
}
</script>


// Inline стили
<div class="circle" :style="getCssClasses"></div>
<div class="circle" :style="[getCssClasses, {'width': height + 'px'}]"></div>

<script>
  getCssClasses: function () {
    let height = (this.height === '') ? 60 : this.height;
    let color = (this.color === '') ? 'gray' : this.color;
    return {
      'background': color,
                'height': height + 'px'
    };
  }
</script>
