const { DataTypes } = require('sequelize');
const sequelize = require('../../util/database.util');
const QUESTION_GENRE = require('../../enums/mbrelax/questionGenre.enum');
const MBRelaxHealthQuestionGenre = require('./MBRelaxHealthQuestionGenre.model');

const MBRelaxHealthQuestion = sequelize.define('MBRelaxHealthQuestion', {
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
    genreAppliedId: {
        type: DataTypes.INTEGER,
        allowNull: false,
        references: {
            model: 'MBRelaxHealthQuestionGenres',
            key: 'id'
        }
    },
    affectsDigestive: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    },
    affectsIntestinal: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    },
    affectsCirculatory: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    },
    affectsNervous: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    },
    affectsImmunological: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    },
    affectsRespiratory: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    },
    affectsUrinary: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    },
    affectsGlandular: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    },
    affectsStructural: {
        type: DataTypes.BOOLEAN,
        defaultValue: false
    }
}, {
    tableName: 'MBRelaxHealthQuestions',
    hooks: {
        afterSync: async (options) => {
            const count = await MBRelaxHealthQuestion.count();
            if (count === 0) {
                const questions = [
                    { name: 'Se siente frecuentemente débil y/o cansado', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 3, 5, 8] },
                    { name: 'Se enferma frecuentemente', genreApplied: QUESTION_GENRE.BOTH, affects: [5] },
                    { name: 'Tiene mal olor corporal o mal aliento', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 2, 6, 7] },
                    { name: 'Siente dificultad al digerir cierto tipo de alimentos', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 5] },
                    { name: 'Consume frecuentemente carnes rojas', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 2, 3, 7] },
                    { name: 'Padece de síndrome pre-menstrual o menopausia', genreApplied: QUESTION_GENRE.FEMALE, affects: [2, 4, 7, 8] },
                    { name: 'Usa frecuentemente Medicina Química', genreApplied: QUESTION_GENRE.BOTH, affects: [3, 4, 5] },
                    { name: 'Consume alcohol regularmente', genreApplied: QUESTION_GENRE.BOTH, affects: [2, 3, 4, 8] },
                    { name: 'Tiene bolsas debajo de los ojos o pies hinchados', genreApplied: QUESTION_GENRE.BOTH, affects: [7] },
                    { name: 'Es fumador activo o pasivo', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 4, 6] },
                    { name: 'Sufre de falta de concentración o memoria', genreApplied: QUESTION_GENRE.BOTH, affects: [3, 4, 8] },
                    { name: 'Se recupera con dificultad de las enfermedades', genreApplied: QUESTION_GENRE.BOTH, affects: [5] },
                    { name: 'Eructa o tiene gases después de las comidas', genreApplied: QUESTION_GENRE.BOTH, affects: [1] },
                    { name: 'Se siente estresado frecuentemente', genreApplied: QUESTION_GENRE.BOTH, affects: [3, 4, 5, 8] },
                    { name: 'Sufre de alergias y/o infecciones en la piel (acné, erupciones)', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 2, 7, 8, 9] },
                    { name: 'Siente antojos por alimentos dulces y/o alimentos procesados (embutidos) enlatados', genreApplied: QUESTION_GENRE.BOTH, affects: [4, 8] },
                    { name: 'Consume productos lácteos regularmente', genreApplied: QUESTION_GENRE.BOTH, affects: [2, 6] },
                    { name: 'Se siente frecuentemente preocupado, ansioso o deprimido', genreApplied: QUESTION_GENRE.BOTH, affects: [2, 4, 8] },
                    { name: 'Siente poco sueño / sueño inquieto', genreApplied: QUESTION_GENRE.BOTH, affects: [8] },
                    { name: 'Sus uñas son quebradizas / se parten en capas', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 9] },
                    { name: 'Su cabello se parte en las puntas o se cae', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 8, 9] },
                    { name: 'Su dieta es alta en grasas o en colesterol', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 3] },
                    { name: 'Sufre de nerviosismo, ansiedad o tensión', genreApplied: QUESTION_GENRE.BOTH, affects: [4, 8] },
                    { name: 'Su dieta es baja en fibras (verduras, frutas, cereales, legumbres)', genreApplied: QUESTION_GENRE.BOTH, affects: [2] },
                    { name: 'Sufre de Calambres musculares', genreApplied: QUESTION_GENRE.BOTH, affects: [4, 9] },
                    { name: 'Está expuesto a contaminación ambiental', genreApplied: QUESTION_GENRE.BOTH, affects: [5, 6] },
                    { name: 'Permanece con sueño a cualquier hora del día', genreApplied: QUESTION_GENRE.BOTH, affects: [3, 8] },
                    { name: 'Consume mucho café, té o gaseosas oscuras "colas"', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 4, 8, 9] },
                    { name: 'Su carácter es explosivo; pierde el control fácilmente', genreApplied: QUESTION_GENRE.BOTH, affects: [4, 5, 8] },
                    { name: 'Es sensible a ciertos alimentos o productos químicos', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 2, 5] },
                    { name: 'Tiene molestias al consumir harinas blancas', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 2, 6] },
                    { name: 'Siente debilidad, dolor en huesos y músculos', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 7, 9] },
                    { name: 'Vive con Preocupaciones constantes o resentimientos guardados', genreApplied: QUESTION_GENRE.BOTH, affects: [1, 4] },
                    { name: 'Es malgenio, se irrita con facilidad', genreApplied: QUESTION_GENRE.BOTH, affects: [2, 4, 8] },
                    { name: 'Hace poco ejercicio', genreApplied: QUESTION_GENRE.BOTH, affects: [2, 3, 5, 9] },
                    { name: 'Presenta exceso de mucosidad (nariz y garganta)', genreApplied: QUESTION_GENRE.BOTH, affects: [6] },
                    { name: 'Sufre de dificultades urinarias', genreApplied: QUESTION_GENRE.BOTH, affects: [2, 7, 8] },
                    { name: 'Tiene poco apetito', genreApplied: QUESTION_GENRE.BOTH, affects: [2, 4, 8] }
                ];

                await MBRelaxHealthQuestion.bulkCreate(questions.map(question => ({
                    name: question.name,
                    genreAppliedId: question.genreApplied,
                    affectsDigestive: question.affects.includes(1),
                    affectsIntestinal: question.affects.includes(2),
                    affectsCirculatory: question.affects.includes(3),
                    affectsNervous: question.affects.includes(4),
                    affectsImmunological: question.affects.includes(5),
                    affectsRespiratory: question.affects.includes(6),
                    affectsUrinary: question.affects.includes(7),
                    affectsGlandular: question.affects.includes(8),
                    affectsStructural: question.affects.includes(9)
                })));
            }
        }
    }
});

MBRelaxHealthQuestion.belongsTo(MBRelaxHealthQuestionGenre, { foreignKey: 'genreAppliedId' });

module.exports = MBRelaxHealthQuestion;