const Sequelize = require('sequelize');
const sequelize = require('../util/database');

const Item = sequelize.define('items', {
  id: {
    type: Sequelize.INTEGER,
    autoIncrement: true,
    allowNull: false,
    primaryKey: true
  },
  name: {
    type: Sequelize.STRING,
    allowNull: false
  },
  next_due_date: {
    type: Sequelize.DATE,
    allowNull: true // Puede ser nulo si no hay una fecha de vencimiento específica
  }
});

module.exports = Item;