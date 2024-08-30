const { DataTypes } = require('sequelize');
const sequelize = require('../util/database.util');
const Role = require('./role.model');
const UserStatus = require('./userStatus.model');
const USER_STATUS = require('../enums/userStatus.enum');
const USER_ROLE = require('../enums/role.enum');

const User = sequelize.define('User', {
  id: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  firstName: {
    type: DataTypes.STRING,
    allowNull: false
  },
  lastName: {
    type: DataTypes.STRING,
    allowNull: false
  },
  email: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  phone: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  roleId: {
    type: DataTypes.INTEGER,
    defaultValue: USER_ROLE.USER,
    allowNull: false,
    references: {
        model: 'Roles',
        key: 'id'
    }
  },
  statusId: {
    type: DataTypes.INTEGER,
    allowNull: false,
    defaultValue: USER_STATUS.INACTIVE,
    references: {
        model: 'UserStatus',
        key: 'id'
    }
  },
  otpCode: {
    type: DataTypes.STRING,
    allowNull: true
  },
  otpTries: {
    type: DataTypes.INTEGER,
    defaultValue: 0,
    allowNull: true,
    validate: {
        min: 0,
        max: 3
    }
  }
});

User.belongsTo(Role, { foreignKey: 'roleId' });
User.belongsTo(UserStatus, { foreignKey: 'statusId' });

module.exports = User;