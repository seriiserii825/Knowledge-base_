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

//router
router.post('/', async(req, res) => {
  try {
    const todo = await Todo.create({
      title: req.body.title,
      done: 0
    });
    res.status(201).json({todo});
    
  }catch (e) {
    console.log(e, 'e')
    res.status(500).json('Server error')
  }
  
});
