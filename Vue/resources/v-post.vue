      fetch('https://vue-http-demo-1bb78.firebaseio.com/surveys.json', {
        method: 'POST',
        headers: {
          'Content-type': 'application/json'
        },
        body: JSON.stringify({
          name: this.enteredName,
          rating: this.chosenRating
        })
      })
