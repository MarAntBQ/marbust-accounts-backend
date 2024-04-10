const Sequelize = require('sequelize');
const sequelize = require('../util/database');

// Define el modelo MenuCategory
const MenuCategory = sequelize.define('menu_categories', {
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
  icon: {
    type: Sequelize.STRING,
    allowNull: false
  },
  role_id: {
    type: Sequelize.INTEGER,
    allowNull: false,
    references: {
      model: 'roles',
      key: 'id'
    }
  },
  level: {
    type: Sequelize.INTEGER,
    allowNull: false
  },
  url: {
    type: Sequelize.STRING, // Se espera que sea una URL, por lo que se define como STRING
    allowNull: true // Permitir que el campo sea nulo, dependiendo de tus requisitos
  },
  active: {
    type: Sequelize.BOOLEAN,
    allowNull: false,
    defaultValue: true
  },
  parent_category_id: {
    type: Sequelize.INTEGER,
    allowNull: true, // Permitir que el campo sea nulo para categorías principales
    references: {
      model: 'menu_categories',
      key: 'id'
    }
  }
});

// Definir la relación con la misma tabla para obtener la categoría principal
MenuCategory.hasMany(MenuCategory, { as: 'subcategories', foreignKey: 'parent_category_id' });

// Definir la relación inversa para obtener la categoría padre
MenuCategory.belongsTo(MenuCategory, { as: 'parent_category', foreignKey: 'parent_category_id' });

// Define la relación con el modelo Role
const Role = require('./role');
MenuCategory.belongsTo(Role, { foreignKey: 'role_id' });

// Exporta el modelo MenuCategory para usarlo en otras partes de la aplicación
module.exports = MenuCategory;
