const express = require('express');
const app = express();


app.get('/about', (req, res) => {
  res.render('about');
  
})

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`)
})

