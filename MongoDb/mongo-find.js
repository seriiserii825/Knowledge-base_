		const tour = await Tour.findById(req.params.id)
		const tour = await Tour.findOne({_id: req.params.id})
		return res.json({ status: "success", tour: tour });
