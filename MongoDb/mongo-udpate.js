router
	.get('/:id', getById)
	.patch('/:id', update)

const update = async (req, res) => {
	try {
		await Tour.findByIdAndUpdate(req.params.id, req.body);
		res.status(200).json({
			status: "success"
		});
	} catch (error) {
		res.status(400).json({
			status: "fail",
			message: error.message
		});
	}
};


    async onSubmit() {
      console.log(this.id, 'this.id')
      try {
        await this.$axios.$patch(process.env.baseUrl + '/api/v1/tours/' + this.id, {
          name: this.name,
          price: this.price
        })
        this.$router.push('/')
      } catch (e) {
        console.log(e, 'e')
      }

    }
