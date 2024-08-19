const { DataTypes } = require('sequelize');
const sequelize = require('../util/database');
const { Role } = require('./role');

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
    unique: true
  },
  phone: {
    type: DataTypes.STRING,
    allowNull: true
  },
  roleId: {
    type: DataTypes.INTEGER,
    defaultValue: 1,
    references: {
        model: 'Roles', // Referencia al modelo Roles
        key: 'id'
    }
  }
});

User.belongsTo(Role, { foreignKey: 'roleId' });

module.exports = User;