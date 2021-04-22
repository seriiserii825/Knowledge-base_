<script>
 data: {
      windowWidth: 0,
    },
},
created(){
      this.windowWidth = window.innerWidth;
      window.addEventListener("resize", this.windowResize);
},
methods: {
      windowResize() {
        this.windowWidth = window.innerWidth;
      }
},
destroyed() {
        window.removeEventListener("resize", this.windowResize);
}
</script>
