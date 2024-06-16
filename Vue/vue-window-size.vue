<script>
 data: {
      showToggleMenu: false,
      windowWidth: 0
    },
},
created(){
    if (process.browser) {
      this.windowWidth = window.innerWidth;
      window.addEventListener("resize", this.windowResize);
    }
},
methods: {
    windowResize() {
      this.windowWidth = window.innerWidth;
      this.showToggleMenu = this.windowWidth <= 992;
    },
},
destroyed() {
        window.removeEventListener("resize", this.windowResize);
}
</script>
