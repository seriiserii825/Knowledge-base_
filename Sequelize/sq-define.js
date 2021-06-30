const Sequelize = require('sequelize');

const sequelize = require('./../db/database');
const User = sequelize.define("User", {
  id: {
    primaryKey: true,
    autoIncrement: true,
    allowNull: false,
    type: Sequelize.INTEGER
  },
  name: {
    allowNull: false,
    type: Sequelize.STRING
  },
  email: {
    allowNull: false,
    type: Sequelize.STRING
  },
  status: {
    type: Sequelize.ENUM("1", "0"),
    defaultValue: "1"
  }
});

module.exports = User;
