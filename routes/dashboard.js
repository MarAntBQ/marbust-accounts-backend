const path = require('path');

const express = require('express');

const dashboardController = require('../controllers/dashboard');

const router = express.Router();

// User Dashboard Home Page
router.get('/home', dashboardController.getHome);

// Export Router to main App
module.exports = router;