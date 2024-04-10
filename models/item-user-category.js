const Sequelize = require('sequelize');
const sequelize = require('../util/database');
const User = require('./user');
const MenuCategory = require('./menu_category');
const Item = require('./item');

const UserItemMenuAssociation = sequelize.define('item_user_category', {
  id: {
    type: Sequelize.INTEGER,
    autoIncrement: true,
    allowNull: false,
    primaryKey: true
  },
  user_id: {
    type: Sequelize.INTEGER,
    allowNull: false,
    references: {
      model: 'users',
      key: 'id'
    }
  },
  item_id: {
    type: Sequelize.INTEGER,
    allowNull: false,
    references: {
      model: 'items',
      key: 'id'
    }
  },
  menu_category_id: {
    type: Sequelize.INTEGER,
    allowNull: false,
    references: {
      model: 'menu_categories',
      key: 'id'
    }
  }
});

UserItemMenuAssociation.belongsTo(User, { foreignKey: 'user_id' });
UserItemMenuAssociation.belongsTo(Item, { foreignKey: 'item_id' });
UserItemMenuAssociation.belongsTo(MenuCategory, { foreignKey: 'menu_category_id' });

module.exports = UserItemMenuAssociation;