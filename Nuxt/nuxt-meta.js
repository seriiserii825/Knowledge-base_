  head() {
    return {
      title: `Post | ${this.post.title}`,
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        {
          name: 'description',
          content: 'my website description'
        }
      ]
    }
  },
