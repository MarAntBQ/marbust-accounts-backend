const { DataTypes } = require('sequelize');
const sequelize = require('../util/database.util');
const User = require('./user.model');
const Role = require('./role.model');
const USER_ROLE = require('../enums/role.enum');

const SystemUpdate = sequelize.define('SystemUpdate', {
  id: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  title: {
    type: DataTypes.STRING(60),
    allowNull: false
  },
  description: {
    type: DataTypes.TEXT,
    allowNull: false
  },
  date: {
    type: DataTypes.DATE,
    allowNull: false
  },
  createdBy: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: 'Users',
      key: 'id'
    }
  },
  fromRoleId: {
    type: DataTypes.INTEGER,
    defaultValue: USER_ROLE.USER,
    references: {
        model: 'Roles',
        key: 'id'
    }
  },
});

SystemUpdate.belongsTo(User, { foreignKey: 'createdBy' });
SystemUpdate.belongsTo(Role, { foreignKey: 'fromRoleId' });

module.exports = SystemUpdate;