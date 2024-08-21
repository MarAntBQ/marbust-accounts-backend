const MBRelaxQuestionGenre = require('../../models/mbrelax/MBRelaxHealthQuestionGenre.model');
const MBRelaxHealthQuestion = require('../../models/mbrelax/MBRelaxHealthQuestion.model');
const MBRelaxHealthSystem = require('../../models/mbrelax/MBRelaxHealthSystem.model');
const QUESTION_GENRE = require('../../enums/mbrelax/questionGenre.enum');
const sendEmail = require('../../services/sendEmail.service');

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
            attributes: ['id', 'name']
        });

        const formattedQuestions = questions.map(question => {

            return {
                id: question.id,
                name: question.name,
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
        const { name, email, phone, address, city, state, answers } = req.body; // answers is an array of question IDs that the client answered "yes" to

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

         // Step 7: Construct email body for "pedidos@mbrelax.xyz"
         const affirmativeQuestions = questions.map(q => `<li>${q.name}</li>`).join('');
         const healthResults = Object.entries(healthStatus).map(([system, status]) => `${system}: ${status}`).join('<br>');
         const emailSubject1 = 'Analisis de Estilo de Vida Recibido';
         const emailBody1 = `
             <p><strong>Nombre:</strong> ${name}</p>
             <p><strong>Email:</strong> ${email}</p>
             <p><strong>Teléfono:</strong> ${phone}</p>
             <p><strong>Dirección:</strong> ${address}</p>
             <p><strong>Ciudad:</strong> ${city}</p>
             <p><strong>Estado:</strong> ${state}</p>
             <p><strong>Preguntas afirmativas:</strong></p>
             <p>${affirmativeQuestions}</p>
             <p><strong>Resultados:</strong></p>
             <p>${healthResults}</p>
         `;
         await sendEmail('pedidos@mbrelax.xyz', emailSubject1, emailBody1);

        // Step 8: Construct email body for the client
        const healthSystemNamesInSpanish = {
            Digestive: 'Digestivo',
            Intestinal: 'Intestinal',
            Circulatory: 'Circulatorio',
            Nervous: 'Nervioso',
            Immune: 'Inmunológico',
            Respiratory: 'Respiratorio',
            Urinary: 'Urinario',
            Glandular: 'Glandular',
            Structural: 'Estructural'
        };

        const translatedHealthResults = Object.entries(healthStatus)
            .map(([system, status]) => `${healthSystemNamesInSpanish[system]}: ${status}`)
            .join('<br>');
        const emailSubject2 = 'Resultados Preliminares de su Evaluación de Salud';
        const emailBody2 = `
            <p>Hemos recibido sus respuestas satisfactoriamente. Tras analizar su estilo de vida, podemos proporcionarle un resultado preliminar sobre el estado de los diferentes sistemas de su organismo, basado en sus respuestas. Un asesor de MBRelax® se pondrá en contacto con usted para ofrecerle un tratamiento adecuado.</p>
            <p>---------------</p>
            <p>Resultados:</p>
            <p>${translatedHealthResults}</p>
            <p>---------------</p>
            <p>Le recordamos que este análisis no constituye una opinión médica profesional. Los resultados presentados se basan únicamente en los hábitos y respuestas proporcionadas, y no deben ser interpretados como un diagnóstico médico.</p>
            <p>Para mayor información contáctanos en <a href="https://mbrelax.xyz/contact/">MBRelax®</a></p>
        `;
        await sendEmail(email, emailSubject2, emailBody2);
        res.status(200).json({ healthStatus });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};