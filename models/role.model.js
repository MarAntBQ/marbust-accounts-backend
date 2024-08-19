const { DataTypes } = require('sequelize');
const sequelize = require('../util/database.util');

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
}, {
  tableName: 'Roles',
  hooks: {
    afterSync: async (options) => {
      const count = await Role.count();
      if (count === 0) {
        await Role.bulkCreate([
          { name: 'User' },
          { name: 'Supervisor' },
          { name: 'Admin' },
          { name: 'Superadmin' }
        ]);
      }
    }
  }
});

module.exports = Role;