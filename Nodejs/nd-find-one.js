//Model
  static async getById(id) {
    const courses = await Courses.getAll();
    return courses.find(item => item.id === id);
  }

// route

router.get("/:id", async (req, res) => {
  const course = await Courses.getById(req.params.id);
  res.render('course', { title: course.title, course })
});
