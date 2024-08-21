const express = require('express');
const userController = require('../controllers/user.controller');
const authMiddleware = require('../middleware/auth.middleware');
const router = express.Router();

router.post('/register', userController.register);
router.post('/verify-otp', userController.verifyOtp);
router.post('/login', userController.login);
router.get('/profile', authMiddleware, userController.getProfile);
router.post('/request-password-reset', userController.requestPasswordReset);
router.post('/change-password', authMiddleware, userController.changePassword);

module.exports = router;