npx sequelize init //first command to init project (will create folders)

/models/index.js // to change mode to production, need to change env in this file to production.

const express = require('express');
const Sequelize = require('sequelize');
const sequelize = new Sequelize('sequilize', 'root', 'Serii1981;', {
  host: "localhost",
  dialect: "mysql"
});

const app = express();
const PORT = 3000;

app.get('/', (req, res) => {
  res.json({ message: 'ok' });
});


