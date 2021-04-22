<template>
  <section>
    <base-card>
      <h2>Submitted Experiences</h2>
      <div>
        <base-button @click="loadResults">Load Submitted Experiences</base-button>
      </div>
      <p v-if="isLoaded">Loading...</p>
      <p v-else-if="!isLoaded && error">{{ error }}</p>
      <p v-else-if="!isLoaded && results.length === 0">Start add new data throw the form, to see a result...</p>
      <ul v-else-if="!isLoaded && results.length > 0">
        <survey-result
          v-for="result in results"
          :key="result.id"
          :name="result.name"
          :rating="result.rating"
        ></survey-result>
      </ul>
    </base-card>
  </section>
</template>

<script>
import SurveyResult from './SurveyResult.vue'

export default {
  data () {
    return {
      results: [],
      isLoaded: false,
      error: null
    }
  },
  methods: {
    loadResults () {
      this.isLoaded = true
      fetch('https://vue-http-demo-1bb78.firebaseio.com/surveys.json')
        .then((result) => {
          if (result.ok) {
            return result.json()
          }
        })
        .then(result => {
          this.isLoaded = false
          const resultArr = []

          for (const elem in result) {
            resultArr.push({
              id: elem,
              name: result[elem].name,
              rating: result[elem].rating
            })
          }
          this.results = resultArr
          this.error = null
        })
        .catch(() => {
          this.isLoaded = false
          this.error = 'Try to fetch data later'
        })
    }
  },
  components: {
    SurveyResult
  },
  mounted () {
    console.log(this.isLoaded)
    this.loadResults()
  }
}
</script>

<style scoped>
ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
</style>
