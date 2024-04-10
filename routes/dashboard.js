const path = require('path');

const express = require('express');

const dashboardController = require('../controllers/dashboard');

const router = express.Router();

// User Dashboard Home Page
router.get('/', dashboardController.getHome);
// User Dashboard Menu Handler with /dashboard/route/
router.get('/:firstRoute', dashboardController.getMenuHandler1);

// Export Router to main App
module.exports = router;