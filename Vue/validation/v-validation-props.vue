<script>
export default {
  props: {
    carName: {
      type: String,
      required: true,
      default: "Porsche"
    },
    carYear: Number
  },
  computed: {
    reverseName() {
      return this.carName.split('').reverse().join('');
    }
  }
}
</script>
