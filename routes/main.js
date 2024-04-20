const path = require('path');

const express = require('express');

const mainController = require('../controllers/main');

const router = express.Router();

// App Home Page
router.get('/', mainController.getHome);

router.get('/login', mainController.getLogin);

router.get('/registration', mainController.getHome);

router.get('/password-recover', mainController.getHome);

// Export Router to main App
module.exports = router;