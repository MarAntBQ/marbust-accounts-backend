const { DataTypes } = require('sequelize');
const sequelize = require('../../util/database.util');
const MarbustEducationCourseCategory = require('./MarbustEducationCourseCategory.model');

const MarbustEducationCourse = sequelize.define('MarbustEducationCourse', {
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
    publishedDate: {
        type: DataTypes.DATE,
        allowNull: false,
        defaultValue: DataTypes.NOW
    },
    categoryId: {
        type: DataTypes.INTEGER,
        allowNull: false,
        references: {
            model: MarbustEducationCourseCategory,
            key: 'id'
        }
    },
    enabled: {
        type: DataTypes.BOOLEAN,
        allowNull: false,
        defaultValue: true
    }
}, {
    tableName: 'MarbustEducationCourses',
});

MarbustEducationCourse.belongsTo(MarbustEducationCourseCategory, { foreignKey: 'categoryId' });
module.exports = MarbustEducationCourse;