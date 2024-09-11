const { DataTypes } = require('sequelize');
const sequelize = require('../../util/database.util');

const MarbustEducationCourseCategory = sequelize.define('MarbustEducationCourseCategory', {
    id: {
        type: DataTypes.INTEGER,
        autoIncrement: true,
        allowNull: false,
        primaryKey: true
    },
    name: {
        type: DataTypes.STRING,
        allowNull: false
    },
}, {
    tableName: 'MarbustEducationCourseCategories',
    hooks: {
        afterSync: async (options) => {
          const count = await MarbustEducationCourseCategory.count();
          if (count === 0) {
            await MarbustEducationCourseCategory.bulkCreate([
              { name: 'Web Design' },
              { name: 'Web Development' },
              { name: 'E-commerce' },
              { name: 'AI' },
              { name: 'Cyber Security' }
            ]);
          }
        }
    }
});

module.exports = MarbustEducationCourseCategory;