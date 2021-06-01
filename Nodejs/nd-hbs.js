const exphbs = require("express-handlebars");

app.engine("handlebars", exphbs());
app.engine(".hbs", exphbs({ defaultLayout: "main" }));
app.engine(".hbs", exphbs({ extname: ".hbs" }));
app.set("view engine", ".hbs");

app.get("/", (req, res) => {
  res.render("index.hbs");
});
///////
{{> header }}
<body>
{{> navbar }}
<div class="container">
    {{{body}}}
</div>

{{> footer }}
</body>
</html>
