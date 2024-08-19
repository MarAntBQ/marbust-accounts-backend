const express = require('express');
const userController = require('../controllers/user');
const authMiddleware = require('../middleware/authMiddleware');
const router = express.Router();

router.post('/register', userController.register);
router.post('/login', userController.login);
router.get('/profile', authMiddleware, userController.getProfile);

module.exports = router;