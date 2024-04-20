const path = require('path');

const express = require('express');

const noAuthController = require('../controllers/no-auth');

const router = express.Router();

// App Home Page
router.get('/', noAuthController.getHome);

router.get('/login', noAuthController.getLogin);

router.get('/register', noAuthController.getRegister);

router.get('/password-recover', noAuthController.getHome);

// Export Router to main App
module.exports = router;