    const queryObj = { ...req.query }
    const excludedFields = ['page', 'sort', 'limit', 'fields']
    excludedFields.forEach((el) => delete queryObj[el])

    const tours = await Tour.find()
    const tours = await Tour.find({
      duration: 5,
      difficulty: 'easy',
    })
    const tours = await Tour.find()
      .where('duration')
      .equals(9)
      .where('difficulty')
      .equals('easy')
