const Role = require('../models/role.model');
const User = require('../models/user.model');

exports.getAllRoles = async (req, res, next) => {
    try {
        const roles = await Role.findAll();
        res.status(200).json({ roles });
    } catch (err) {
        console.log(err);
        res.status(500).json({ message: 'Fetching roles failed.' });
    }
};

exports.getAllUsers = async (req, res, next) => {
    try {
        const user = await User.findAll();
        res.status(200).json({ user });
    } catch (err) {
        console.log(err);
        res.status(500).json({ message: 'Fetching users failed.' });
    }
};