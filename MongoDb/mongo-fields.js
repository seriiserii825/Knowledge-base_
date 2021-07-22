http://localhost:3000/api/v1/tours?fields=duration,price,name,difficulty
// minus in url, will exclude field

    if (req.query.fields) {
      const queryString = req.query.fields.split(",").join(" ");
      console.log(queryString, "queryString");
      query = query.select(queryString);
    } else {
      // select(-) - minus = excerpt fields
      query = query.select("-__v");
    }
