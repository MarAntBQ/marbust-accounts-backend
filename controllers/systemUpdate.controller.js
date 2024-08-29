const config = require('../config');
const sendEmail = require('../services/sendEmail.service');

const SystemUpdate = require('../models/systemUpdate.model');
const User = require('../models/user.model');
const Role = require('../models/role.model');

exports.viewAll = async (req, res) => {
    try {
        const systemUpdates = await SystemUpdate.findAll({
            include: [
                {
                    model: User,
                    attributes: ['firstName', 'lastName']
                }
            ]
        });
        const updates = systemUpdates
            .filter(update => update.fromRoleId <= req.roleId)
            .map(update => {
                return {
                    id: update.id,
                    title: update.title,
                    description: update.description,
                    date: update.date.toISOString().split('T')[0],
                    createdBy: `${update.User.firstName} ${update.User.lastName}`
                };
        });
        res.status(200).json(updates);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
}

exports.createNew = async (req, res) => {
    const { title, description, date, roleId } = req.body;
    try {
        const maxRoleId = await Role.max('id');
        
        if (roleId > maxRoleId) {
            return res.status(400).json({ error: `El roleId ${roleId} excede el rol máximo permitido de ${maxRoleId}.` });
        }

        const newUpdate = await SystemUpdate.create({
            title,
            description,
            date,
            createdBy: req.userId,
            fromRoleId: roleId
        });
        res.status(201).json(newUpdate);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};