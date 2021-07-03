const validate = async (req, res) => {
  const token = req.headers["authorization"];
  if (token) {
    const candidate = jwt.verify(token, jwtConfig.secret, (error, decode) => {
      if (error) {
        res.status(500).json(error);
      } else {
        res.json(decode);
      }
    });
  } else {
    res.status(404).json({ message: "Token not found" });
  }
};
