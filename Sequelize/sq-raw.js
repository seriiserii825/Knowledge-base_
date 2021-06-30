router.get("/", async (req, res) => {
  try {
    const users = await sequelize.query("SELECT * FROM Users", {
      type: sequelize.QueryTypes.SELECT
    });
    if (users && users.length > 0) {
      res.status(200).json({ users });
    }else{
      res.status(200).json({ users: [] });
    }
  } catch (err) {
    // Если возникает проблема, то возвращаем ошибку сервера.
    res.status(500).json({ message: err.message });
  }
});
