router.get("/", async (req, res) => {
  const courses = await Courses.find();
  const coursesJson = courses.map(item => {
    return item.toObject();
  })
  
  res.render("courses", { title: "Courses", courses: coursesJson });
});
