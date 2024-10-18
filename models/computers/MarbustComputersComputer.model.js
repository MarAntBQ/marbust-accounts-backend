const { DataTypes } = require('sequelize');
const sequelize = require('../../util/database.util');
const COMPUTER_TYPE = require('../../enums/computers/computerType.enum');
const User = require('../user.model');

const MarbustComputersComputer = sequelize.define('MarbustComputersComputer', {
  id: {
    type: DataTypes.INTEGER,
    autoIncrement: true,
    primaryKey: true
  },
  name: {
    type: DataTypes.STRING,
    allowNull: false
  },
  userId: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: User,
      key: 'id'
    }
  },
  nextMaintenance: {
    type: DataTypes.DATE,
    allowNull: false,
    defaultValue: DataTypes.NOW
  },
  computerType: {
    type: DataTypes.INTEGER,
    allowNull: false,
    defaultValue: COMPUTER_TYPE.DESKTOP
  },
  enabled: {
    type: DataTypes.BOOLEAN,
    allowNull: false,
    defaultValue: true
  }
}, {
  tableName: 'MarbustComputersComputers',
});

MarbustComputersComputer.belongsTo(User, { foreignKey: 'userId' });

module.exports = MarbustComputersComputer;