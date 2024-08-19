const User = require('../models/user.model');

const checkSuperAdminRole = async (req, res, next) => {
    try {
        const user = await User.findByPk(req.userId);
        if (!user) {
            return res.status(404).json({ message: 'User not found.' });
        }

        if (user.roleId !== 4) {
            return res.status(403).json({ message: 'Require super admin role.' });
        }

        next();
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

module.exports = checkSuperAdminRole;