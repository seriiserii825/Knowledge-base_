router.post("/create", async (req, res) => {
  try {
    const { form: { name, email, rollNo, status } } = await req.body;
    const user = await User.create({
      name, email, rollNo, status
    });
    if (user) {
      res.status(200).json({ response: "User was created" });
    } else {
      res.status(500).json({ response: "Error during create user" });
    }
  } catch (err) {
    // Если возникает проблема, то возвращаем ошибку сервера.
    res.status(500).json({ message: err.message });
  }
});
