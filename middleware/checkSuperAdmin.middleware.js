const User = require('../models/user.model');
const USER_ROLE = require('../enums/role.enum');
const USER_STATUS = require('../enums/userStatus.enum');

const checkSuperAdminRole = async (req, res, next) => {
    try {
        const user = await User.findByPk(req.userId);
        if (!user) {
            return res.status(404).json({ message: 'User not found.' });
        }

        if (user.roleId !== USER_ROLE.SUPER_ADMIN && user.statusId !== USER_STATUS.ACTIVE) {
            return res.status(403).json({ message: 'Require super admin role.' });
        }

        next();
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

module.exports = checkSuperAdminRole;