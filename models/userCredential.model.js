const { DataTypes } = require('sequelize');
const sequelize = require('../util/database.util');
const User = require('./user.model');

const UserCredential = sequelize.define('UserCredential', {
  id: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  userId: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: 'Users', // Referencia al modelo Users
      key: 'id'
    }
  },
  password: {
    type: DataTypes.STRING,
    allowNull: false
  }
});

UserCredential.belongsTo(User, { foreignKey: 'userId' });

module.exports = UserCredential;