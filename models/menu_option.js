const Sequelize = require('sequelize');
const sequelize = require('../util/database');

// Define el modelo MenuOption
const MenuOption = sequelize.define('menu_options', {
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
  parent_option_id: {
    type: Sequelize.INTEGER,
    allowNull: true, // Permitir que el campo sea nulo para categorías principales
    references: {
      model: 'menu_options',
      key: 'id'
    }
  }
});

// Definir la relación con la misma tabla para obtener la categoría principal
MenuOption.hasMany(MenuOption, { as: 'suboptions', foreignKey: 'parent_option_id' });

// Definir la relación inversa para obtener la categoría padre
MenuOption.belongsTo(MenuOption, { as: 'parent_option', foreignKey: 'parent_option_id' });

// Define la relación con el modelo Role
const Role = require('./role');
MenuOption.belongsTo(Role, { foreignKey: 'role_id' });

// Exporta el modelo MenuOption para usarlo en otras partes de la aplicación
module.exports = MenuOption;
