const MBRelaxQuestionGenre = require('../../models/mbrelax/MBRelaxHealthQuestionGenre.model');
const MBRelaxHealthQuestion = require('../../models/mbrelax/MBRelaxHealthQuestion.model');
const MBRelaxHealthSystem = require('../../models/mbrelax/MBRelaxHealthSystem.model');
const QUESTION_GENRE = require('../../enums/mbrelax/questionGenre.enum');

exports.getQuestionsByGender = async (req, res) => {
    const gender = req.params.gender.toLowerCase();
    let genreApplied;

    if (gender === 'male') {
        genreApplied = [QUESTION_GENRE.MALE, QUESTION_GENRE.BOTH];
    } else if (gender === 'female') {
        genreApplied = [QUESTION_GENRE.FEMALE, QUESTION_GENRE.BOTH];
    } else {
        return res.status(400).json({ error: 'Invalid gender' });
    }

    try {
        const questions = await MBRelaxHealthQuestion.findAll({
            where: {
                genreAppliedId: genreApplied
            },
            attributes: ['id', 'name', 'affectsDigestive', 'affectsIntestinal', 'affectsCirculatory', 'affectsNervous', 'affectsImmunological', 'affectsRespiratory', 'affectsUrinary', 'affectsGlandular', 'affectsStructural']
        });

        const formattedQuestions = questions.map(question => {
            const systems = [];
            if (question.affectsDigestive) systems.push('Digestive');
            if (question.affectsIntestinal) systems.push('Intestinal');
            if (question.affectsCirculatory) systems.push('Circulatory');
            if (question.affectsNervous) systems.push('Nervous');
            if (question.affectsImmunological) systems.push('Immunological');
            if (question.affectsRespiratory) systems.push('Respiratory');
            if (question.affectsUrinary) systems.push('Urinary');
            if (question.affectsGlandular) systems.push('Glandular');
            if (question.affectsStructural) systems.push('Structural');

            return {
                id: question.id,
                name: question.name,
                systems: systems
            };
        });

        res.json(formattedQuestions);
    } catch (error) {
        res.status(500).json({ error: 'Internal Server Error' });
    }
};

exports.getSystems = async (req, res, next) => {
    try {
        const systems = await MBRelaxHealthSystem.findAll({
            attributes: ['id', 'name', 'description']
        });
        res.status(200).json(systems);
    } catch (error) {
        res.status(500).json({ error: 'Error fetching systems' });
    }
};

exports.calculateHealthStatus = async (req, res) => {
    try {
        const { answers } = req.body; // answers is an array of question IDs that the client answered "yes" to

        const questions = await MBRelaxHealthQuestion.findAll({
            where: {
                id: answers
            }
        });

        const healthScores = {
            digestive: 0,
            intestinal: 0,
            circulatory: 0,
            nervous: 0,
            immunological: 0,
            respiratory: 0,
            urinary: 0,
            glandular: 0,
            structural: 0
        };

        questions.forEach(question => {
            if (question.affectsDigestive) healthScores.digestive++;
            if (question.affectsIntestinal) healthScores.intestinal++;
            if (question.affectsCirculatory) healthScores.circulatory++;
            if (question.affectsNervous) healthScores.nervous++;
            if (question.affectsImmunological) healthScores.immunological++;
            if (question.affectsRespiratory) healthScores.respiratory++;
            if (question.affectsUrinary) healthScores.urinary++;
            if (question.affectsGlandular) healthScores.glandular++;
            if (question.affectsStructural) healthScores.structural++;
        });

        const healthSystems = await MBRelaxHealthSystem.findAll();

        const healthStatus = {};

        healthSystems.forEach(system => {
            const score = healthScores[system.name.toLowerCase()];
            if (score <= system.veryGoodHealthMax) {
                healthStatus[system.name] = 'MUY BUENA SALUD';
            } else if (score <= system.goodHealthMax) {
                healthStatus[system.name] = 'BUENA SALUD';
            } else if (score <= system.regularHealthMax) {
                healthStatus[system.name] = 'SALUD REGULAR';
            } else {
                healthStatus[system.name] = 'MALA SALUD';
            }
        });

        res.status(200).json({ healthStatus });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};