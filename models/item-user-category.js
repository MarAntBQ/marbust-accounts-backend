const Sequelize = require('sequelize');
const sequelize = require('../util/database');
const User = require('./user');
const ItemCategory = require('./item_category');
const Item = require('./item');

const ItemUserCategory = sequelize.define('item_user_category', {
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
  category_id: {
    type: Sequelize.INTEGER,
    allowNull: false,
    references: {
      model: 'item_categories',
      key: 'id'
    }
  }
});

ItemUserCategory.belongsTo(User, { foreignKey: 'user_id' });
ItemUserCategory.belongsTo(Item, { foreignKey: 'item_id' });
ItemUserCategory.belongsTo(ItemCategory, { foreignKey: 'category_id' });

module.exports = ItemUserCategory;