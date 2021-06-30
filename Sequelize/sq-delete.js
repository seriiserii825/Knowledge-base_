router.delete("/user/delete/:id", async (req, res) => {
  try {
    await User.destroy({
      where: {
        id: {
          [Op.eq]: req.params.id
        }
      }
    });
    res.status(200).json({ message: "user was destroyed" });
  } catch (err) {
    // Если возникает проблема, то возвращаем ошибку сервера.
    res.status(500).json({ message: err.message });
  }
});
