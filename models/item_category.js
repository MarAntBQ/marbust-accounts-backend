const Sequelize = require('sequelize');
const sequelize = require('../util/database');

// Define el modelo MenuCategory
const ItemCategory = sequelize.define('item_categories', {
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
  active: {
    type: Sequelize.BOOLEAN,
    allowNull: false,
    defaultValue: true
  },
});

// Exporta el modelo MenuCategory para usarlo en otras partes de la aplicación
module.exports = ItemCategory;
