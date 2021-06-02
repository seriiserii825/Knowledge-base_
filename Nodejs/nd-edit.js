//link
<a href="/courses/{{ id }}/edit" class="btn btn-danger">Edit course</a>

//router
router.get("/:id/edit", async (req, res) => {
  const course = await Courses.getById(req.params.id);
  res.render('course-edit', { title: course.title, course })
});
router.post("/edit", async (req, res) => {
  const course = req.body;
  try {
    await Courses.update(course);
  } catch (e) {
    throw new Error(e)
  }
  
  res.redirect('/courses');
});

//model
  static async update(course) {
    const courses = await Courses.getAll();
    const index = courses.findIndex(item => item.id === course.id);
    courses[index] = course;
    
    const result = JSON.stringify(courses);
    
    return new Promise((resolve, reject) => {
      fs.writeFile(
        path.join(__dirname, "../data", "courses.data.json"),
        result,
        (err) => {
          if (err) {
            reject(err);
          } else {
            resolve();
          }
        }
      );
    });
  }
