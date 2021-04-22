
    loadResults () {
      fetch('https://vue-http-demo-1bb78.firebaseio.com/surveys.json')
        .then((result) => {
          if (result.ok) {
            return result.json()
          }
        })
        .then(result => {
          const resultArr = []

          for (const elem in result) {
            resultArr.push({
              id: elem,
              name: result[elem].name,
              rating: result[elem].rating
            })
          }

          this.results = resultArr
        })
    }
