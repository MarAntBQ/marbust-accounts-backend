const { DataTypes } = require('sequelize');
const sequelize = require('../../util/database.util');

const MBRelaxHealthSystem = sequelize.define('MBRelaxHealthSystem', {
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
    description: {
        type: DataTypes.STRING,
        allowNull: true
    },
    veryGoodHealthMax: {
        type: DataTypes.INTEGER,
        allowNull: false
    },
    goodHealthMax: {
        type: DataTypes.INTEGER,
        allowNull: false
    },
    regularHealthMax: {
        type: DataTypes.INTEGER,
        allowNull: false
    }
}, {
    tableName: 'MBRelaxHealthSystems',
    hooks: {
        afterSync: async (options) => {
            const count = await MBRelaxHealthSystem.count();
            if (count === 0) {
                const systems = [
                    { name: 'Digestive', description: 'System responsible for digestion', veryGoodHealthMax: 1, goodHealthMax: 3, regularHealthMax: 5 },
                    { name: 'Intestinal', description: 'System responsible for intestinal health', veryGoodHealthMax: 1, goodHealthMax: 3, regularHealthMax: 5 },
                    { name: 'Circulatory', description: 'System responsible for blood circulation', veryGoodHealthMax: 0, goodHealthMax: 1, regularHealthMax: 3 },
                    { name: 'Nervous', description: 'System responsible for nervous functions', veryGoodHealthMax: 1, goodHealthMax: 3, regularHealthMax: 5 },
                    { name: 'Immune', description: 'System responsible for immune response', veryGoodHealthMax: 1, goodHealthMax: 3, regularHealthMax: 5 },
                    { name: 'Respiratory', description: 'System responsible for breathing', veryGoodHealthMax: 0, goodHealthMax: 1, regularHealthMax: 3 },
                    { name: 'Urinary', description: 'System responsible for urine production', veryGoodHealthMax: 0, goodHealthMax: 1, regularHealthMax: 3 },
                    { name: 'Glandular', description: 'System responsible for gland functions', veryGoodHealthMax: 1, goodHealthMax: 3, regularHealthMax: 5 },
                    { name: 'Structural', description: 'System responsible for body structure', veryGoodHealthMax: 0, goodHealthMax: 1, regularHealthMax: 3 }
                ];

                await MBRelaxHealthSystem.bulkCreate(systems);
            }
        }
    }
});

module.exports = MBRelaxHealthSystem;