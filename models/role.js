const { DataTypes } = require('sequelize');
const sequelize = require('../util/database');

const Role = sequelize.define('Role', {
  id: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  name: {
    type: DataTypes.STRING,
    allowNull: false
  }
});

const createDefaultRoles = async () => {
  const roles = ['User', 'Supervisor', 'Admin', 'Superadmin'];
  for (let i = 0; i < roles.length; i++) {
      await Role.findOrCreate({ where: { name: roles[i] } });
  }
};

module.exports = { Role, createDefaultRoles };