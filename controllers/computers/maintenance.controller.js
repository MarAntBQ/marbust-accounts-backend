const config = require('../../config');
const sendEmail = require('../../services/sendEmail.service');

const Computer = require('../../models/computers/MarbustComputersComputer.model');


exports.getMyComputers = async (req, res) => {
    try {
        const computers = await Computer.findAll({
            where: {
                userId: req.userId
            }
        });
        res.status(200).json(computers);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Error procesando la solicitud', serverReport: error});
    }
}