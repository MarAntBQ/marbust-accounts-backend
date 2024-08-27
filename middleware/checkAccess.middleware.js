const User = require('../models/user.model');
const USER_STATUS = require('../enums/userStatus.enum');

// Check if the current role is enable to access from the minimum role required
const checkAccess = (minimumRole) => async (req, res, next) => {
    try {
        const user = await User.findByPk(req.userId);
        if (!user) {
            return res.status(404).json({ error: 'User not found.' });
        }

        if (req.roleId < minimumRole) {
            return res.status(403).json({ error: 'Unauthorized access.' });
        } else if (user.statusId !== USER_STATUS.ACTIVE) {
            return res.status(403).json({ error: 'User Account is not active, please contact Admin.' });
        }

        next();
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
}

module.exports = checkAccess;