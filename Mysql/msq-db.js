npm i sequelize mysql2

#file utils/database.js

const Sequelize = require("sequelize");
const DB_NAME = "todos";
const USER = "root";
const PASS = "Serii1981;";

const sequelize = new Sequelize(DB_NAME, USER, PASS, {
  host: "localhost",
  dialect: "mysql"
});

module.exports = sequelize;

#index.js
const sequelize = require("./utils/database");

async function start() {
  try {
    await sequelize.sync();
    app.listen(PORT);
  } catch (error) {
    console.log(error, "error");
  }
}
start();
