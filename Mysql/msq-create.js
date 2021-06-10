//app.js
fetch('/api/todo', {
  method: 'post',
  headers: {'Content-type': 'application/json'},
  body: JSON.stringify({title: this.inputForm})
})
  .then(res => res.json())
  .then(({todo}) => {
    todo.done = Boolean(todo.done)
    this.todos.push(todo)
    this.inputForm = "";
})
  .catch(error => console.log(error, 'error'))

const CategoryModel = require('./../models').Category;

/* GET users listing. */
router.route('/admin/add-category')
  .get(function (req, res, next) {
    res.render('admin/add-category', { title: 'Express' });
  })
  .post(async function (req, res, next) {
    const { name, status } = req.body;
      const category = await CategoryModel;
      await category.create({name, status})
      res.redirect('/admin/add-category');
  });
