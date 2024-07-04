const path = require('path');

// It requires to call the framework
const express = require('express');

// Import Accounts Controller
const accountsController = require('../controllers/accounts');

// Call the function Router from express
const router = express.Router();

router.post('/register', accountsController.createAccount);
router.post('/login', accountsController.loginSetup);
router.post('/recover-password', accountsController.forgotPasswordSetup);
router.post('/logout', accountsController.logoutSettings);

// Export Router to main App
module.exports = router;