<template>
  <div id="app">
    <div class="form-group">
      <label for="name">Car name</label>
      <input class="form-control" type="text" id="name" v-model.trim="carName">
    </div>
    <div class="form-group">
      <label for="year">Car year</label>
      <input class="form-control" type="text" id="year" v-model.number="carYear">
    </div>
    <button class="btn btn-success" @click="createCar">Create new car</button>
    <button class="btn btn-primary" @click="loadCars">Load cars</button>

    <ul class="list-group">
      <li class="list-group-item" v-for="car in cars" :key="car.id">
        <strong>{{ car.name }}</strong> -
        <span>{{ car.year }}</span>
      </li>
    </ul>
  </div>
</template>

<script>

export default {
  name: 'App',
  data() {
    return {
      carName: '',
      carYear: 2018,
      cars: this.loadCars()
    }
  },
  methods: {
    createCar() {
      const car = {
        name: this.carName,
        year: this.carYear
      }

      if (this.carName !== '') {
        this.$http.post('http://localhost:3000/cars', car)
            .then(response => {
              return response.json()
            })
            .then(newCar => {
              this.carName = ''
              this.carYear = ''

              console.log(newCar)
            })
      }
    },

    loadCars() {
      this.$http.get('http://localhost:3000/cars')
          .then(response => {
            return response.json()
          })
          .then(cars => {
            this.cars = cars
          })
    }
  }
}
</script>

<style>
#app {
  margin: 60px auto;
  max-width: 600px;
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.form-group {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
label {
  width: 20%;
}
.form-control {
  width: 80%;
}
.list-group {
  margin-top: 80px;
}
.list-group-item {
  text-align: left;
}
</style>
