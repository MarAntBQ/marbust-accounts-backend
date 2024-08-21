// Check if the current role is enable to access from the minimum role required
const checkAccess = (minimumRole) => async (req, res, next) => {
    try {
        if (req.roleId < minimumRole) {
            return res.status(403).json({ message: 'Unauthorized access.' });
        }

        next();
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
}