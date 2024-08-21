const { DataTypes } = require('sequelize');
const sequelize = require('../../util/database.util');

const MBRelaxHealthQuestionGenre = sequelize.define('MBRelaxHealthQuestionGenre', {
    id: {
        type: DataTypes.INTEGER,
        autoIncrement: true,
        allowNull: false,
        primaryKey: true
    },
    name: {
        type: DataTypes.STRING,
        allowNull: false
    }
}, {
    hooks: {
        afterSync: async (options) => {
            const count = await MBRelaxHealthQuestionGenre.count();
            if (count === 0) {
                await MBRelaxHealthQuestionGenre.bulkCreate([
                    { name: 'MALE' },
                    { name: 'FEMALE' },
                    { name: 'BOTH' }
                ]);
            }
        }
    }
});

module.exports = MBRelaxHealthQuestionGenre;