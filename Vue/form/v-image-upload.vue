<template id="">
    <input type="file" style="display: none" accept="image/*" ref="fileUpload" @change="onFileChange">
    <Button label="Upload" @click.native="triggerUpload" type="button"></Button>
</template>
<script charset="utf-8">
    triggerUpload () {
      this.$refs.fileUpload.click()
    },
    onFileChange (event) {
      const file = event.target.files[0]
      const reader = new FileReader()
      reader.onload = e => {
        this.imgSrc = reader.result
      }
      reader.readAsDataURL(file)
      this.image = file
    }
</script>
