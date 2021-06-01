const express = require('express');
const app = express();

// before routes to show res.body response 
app.use(express.urlencoded({ extended: true }));

app.get('/about', (req, res) => {
  res.render('about');
  
})

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`)
})

