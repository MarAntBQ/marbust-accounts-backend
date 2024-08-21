const jwt = require('jsonwebtoken');
const config = require('../config');

module.exports = (req, res, next) => {
    const authHeader = req.get('Authorization');
    if (!authHeader) {
        return res.status(401).json({ message: 'Not authenticated.' });
    }
    const token = authHeader.split(' ')[1];
    let decodedToken;
    try {
        decodedToken = jwt.verify(token, config.jwtSecret);
    } catch (err) {
        return res.status(500).json({ message: 'Token verification failed.' });
    }
    if (!decodedToken) {
        return res.status(401).json({ message: 'Not authenticated.' });
    }
    req.userId = decodedToken.userId;
    req.roleId = decodedToken.roleId;
    next();
};