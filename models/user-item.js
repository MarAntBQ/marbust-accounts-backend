const Sequelize = require('sequelize');
const sequelize = require('../util/database');
const User = require('./accounts');

const UserItem = sequelize.define('user_items', {
  id: {
    type: Sequelize.INTEGER,
    autoIncrement: true,
    allowNull: false,
    primaryKey: true
  },
  name: Sequelize.STRING,
  next_due_date: Sequelize.DATE,
  user_id: {
    type: Sequelize.INTEGER,
    allowNull: false,
    references: {
      model: 'users',
      key: 'id'
    }
  }
});

// Definir la relación con el modelo User
UserItem.belongsTo(User, { foreignKey: 'user_id' });

module.exports = UserItem;
