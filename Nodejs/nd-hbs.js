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

The cleanest method is to make sure the the handlebars-input is a proper plain javascript object. This can be done in Mongoose, by calling toJSON() or toObject
app.get('/test', function (_req, res) {
    Kitten.find({}).then(kittens => {
        res.render('test.hbs', {
            kittens: kittens.map(kitten => kitten.toJSON())
        })
    })
});
