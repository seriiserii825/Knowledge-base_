const login = async (req, res) => {
  const { email, password } = req.body;
  try {
    const student = await Student.findOne({
      where: {
        email: {
          [Op.eq]: email
        }
      }
    });
    if (student) {
      const correctPassword = await bcrypt.compare(password, student.password);
      if (correctPassword) {
        const token = jwt.sign(
          { id: student.id, email: student.email },
          jwtConfig.secret,
          {
            expiresIn: 60 * 2
          }
        );

        res.json({ message: "Student is logged in", token });
      } else {
        res.status(404).json({ message: "Student password doesn't exists" });
      }
    } else {
      res.status(404).json({ message: "Student email doesn't exists" });
    }
  } catch (error) {
    console.log(error, "error");
  }
};
