const path = require('path');

// It requires to call the framework
const express = require('express');

// Import Accounts Controller
const accountsController = require('../controllers/accounts');

// Call the function Router from express
const router = express.Router();

// Register View
router.get('/register', accountsController.getRegister);
// Login Page
router.get('/login', accountsController.getLogin);
// Logout Function
router.get('/logout', accountsController.logoutSettings);
// Sign in and Login Function
router.post('/controller', accountsController.accountsSetup);

// Export Router to main App
module.exports = router;