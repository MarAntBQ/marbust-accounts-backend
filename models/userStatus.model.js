const { DataTypes } = require('sequelize');
const sequelize = require('../util/database.util');

const UserStatus = sequelize.define('UserStatus', {
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
    tableName: 'UserStatus',
    hooks: {
      afterSync: async (options) => {
        const count = await UserStatus.count();
        if (count === 0) {
          await UserStatus.bulkCreate([
            { name: 'Active' },
            { name: 'Inactive' },
            { name: 'Suspended' }
          ]);
        }
      }
    }
  });
module.exports = UserStatus;