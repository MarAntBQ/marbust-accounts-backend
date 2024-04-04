const path = require('path');

const express = require('express');

const mainController = require('../controllers/main');

const router = express.Router();

// App Home Page
router.get('/', mainController.getHome);

// Export Router to main App
module.exports = router;