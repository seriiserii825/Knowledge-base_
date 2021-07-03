const create = async (req, res) => {
  const { name, email, password } = req.body;
  try {
    const student = await Student.findOne({
      where: {
        email: {
          [Op.eq]: email
        }
      }
    });

    if (student) {
      res.status(200).json({ message: "Email exists, try another" });
    } else {
      await Student.create({
        name: name,
        email: email,
        password: bcrypt.hashSync(password, 10)
      });
      res.status(201).json({ message: "User was created" });
    }
  } catch (error) {
    console.log(error);
    throw error;
  }
};
