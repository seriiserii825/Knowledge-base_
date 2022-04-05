<template>
  <div class="skills">
    <section-header title="Мои навыки"/>
    <div class="skills__wrap">
      <div class="skills__item">
        <ProgressComponent title="Vue" :percent="90" color="green"  logo_url="/svg/vue.svg"/>
      </div>
      <div class="skills__item">
        <ProgressComponent title="Wordpress" :percent="100" color="#28719A"  logo_url="/svg/wordpress.svg"/>
      </div>
      <div class="skills__item">
        <ProgressComponent title="React" :percent="60" color="#00D9FD" logo_url="/svg/react.svg"/>
      </div>
      <div class="skills__item">
        <ProgressComponent title="Laravel" :percent="50" color="#E72635" logo_url="/svg/laravel.png"/>
      </div>
    </div>
  </div>
</template>
<template>
  <div class="progress">
    <h3 class="progress__title">{{ title }}</h3>
    <div class="progress__svg">
      <svg width="200" height="200" class="chart-container" :style="`stroke-dasharray: ${current}, 1000;`">
        <circle cx="100" cy="100" r="90" fill="none" :style="`stroke: ${current_color}`" class="svg"></circle>
      </svg>
      <div class="progress__percent">{{ percent }} %</div>
      <img class="progress__logo" :src="logo_url" alt="">
    </div>
  </div>
</template>
<script>

export default {
  props: ['percent', 'title', 'color', 'logo_url'],
  data() {
    return {
      full: 560,
      current: 0,
      current_color: "#ff8d00"
    }
  },
  mounted() {
    this.current_color = this.color ? this.color : this.current_color;
    setTimeout(() => {
      this.current = this.full * +this.percent / 100;
    });
  }
}
</script>
<style lang="scss">
.progress {
  &__title {
    margin-bottom: 2rem;
  }
  &__svg {
    position: relative;
    margin-bottom: 3rem;
    width: 20rem;
    height: 20rem;
    .svg {
      position: relative;
      //stroke: #ff8d00;
      stroke-width: 10;
      stroke-linecap: round;
      transform: rotate(90deg);
      transform-origin: center;
      z-index: 1;
      transition: all 3s ease-out;
    }
  }
  &__logo {
    position: absolute;
    top: 70%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 6rem;
    height: 6rem;
  }
  &__percent {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3rem;
    font-weight: bold;
  }
}
</style>
