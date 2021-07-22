http://localhost:3000/api/v1/tours?sort=-price,-ratingsQuantity

const fetchAll = async (req, res) => {
  try {
    const queryObj = { ...req.query };
    const excludedFields = ["page", "sort", "limit", "fields"];
    excludedFields.forEach((el) => delete queryObj[el]);

    let queryString = JSON.stringify(queryObj);

    queryString = queryString.replace(
      /\b(gte|gt|lte|lt)\b/g,
      (item) => `$${item}`
    );

    let query = Tour.find(JSON.parse(queryString));

    if (req.query.sort) {
      const sortBy = req.query.sort.split(",").join(" ");
      query = query.sort(sortBy);
    } else {
      query = query.sort("createdAt");
    }

    const tours = await query;

    return res.json({ status: "success", results: tours.length, data: tours });
  } catch (e) {
    console.log(e, "e");
    return res.json({ status: "fail", message: e.message });
  }
};
