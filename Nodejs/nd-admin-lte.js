const adminRouter = require("./routes/admin");
app.use("/admin", express.static(path.join(__dirname, "public")));
app.use("/admin/:any", express.static(path.join(__dirname, "public")));

app.use("/", adminRouter);

// Copy dir plugins and dist from admin-lte to /public directory in project node js
