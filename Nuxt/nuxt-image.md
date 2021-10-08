.products-block(:style="{backgroundImage: `url(${bgImage})`}")
computed: {
        bgImage(){
                return require(`~/assets/i/${this.backgroundImage}`);
        }
},

html
<template>
  <img src="~/assets/your_image.png" />
</template>

dynamic html
<img :src="require(`~/assets/img/${image}.jpg`)" />
