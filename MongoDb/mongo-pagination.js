http://localhost:3000/api/v1/tours?page=4&limit=4&sort=price&fields=name,price
    const page = req.query.page * 1 || 1;
    const limit = req.query.limit * 1 || 2;
    const skip = (page - 1) * limit;

    query = query.skip(skip).limit(limit);

    if (req.query.page) {
      const toursCount = await Tour.countDocuments();
      const pageLimit = page * limit;
      const pageLimitWithoutLimit = pageLimit - limit + 1;
      if (pageLimitWithoutLimit > toursCount) {
        throw new Error("This page doesn't exist'");
      }
    }
