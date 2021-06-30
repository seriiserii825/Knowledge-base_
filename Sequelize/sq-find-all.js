router.get("/", async (req, res) => {
  try {
    const users = await User.findAll({
      where: {
        status: {
          [Op.eq]: "1"
        }
      }
    });
    if (users && users.length) {
      res.status(200).json({ users });
    }
  } catch (err) {
    // Если возникает проблема, то возвращаем ошибку сервера.
    res.status(500).json({ message: err.message });
  }
});
