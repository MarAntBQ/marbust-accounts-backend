const express = require('express');
const userController = require('../controllers/userController');
const authMiddleware = require('../middleware/auth.middleware');
const router = express.Router();

router.post('/register', userController.register);
router.post('/login', userController.login);
router.get('/profile', authMiddleware, userController.getProfile);

module.exports = router;