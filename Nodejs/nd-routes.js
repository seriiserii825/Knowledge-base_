// home.js
const { Router } = require("express");
const router = Router();

router.get("/", (req, res) => {
  res.render("index.hbs", { title: "Home page", isHome: true });
});

module.exports = router;

// index.js
const homeRouter = require("./routes/home");
app.use("/", homeRouter);
