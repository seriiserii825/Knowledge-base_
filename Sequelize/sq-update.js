router.post("/update", async (req, res) => {
  // User.bulkCreate([{}, {}, {}]);
  try {
    const { form: {id, name, email, status } } = await req.body;
    const user = await User.update({
      name, email, status
    }, {
      where: {
        id: {
          [Op.eq]: id
        }
      }
    });
    if (user) {
      res.status(200).json({ response: "User was updated" });
    } else {
      res.status(500).json({ response: "Error during update user" });
    }
  } catch (err) {
    // Если возникает проблема, то возвращаем ошибку сервера.
    res.status(500).json({ message: err.message });
  }
});
