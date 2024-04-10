const express = require('express');

const adminController = require('../controllers/admin');

// Import Accounts Controller
const accountsController = require('../controllers/accounts');

const router = express.Router();

// Admin Home Page
router.get('/', adminController.getHome);

// Admin Dashboard Menu Handler with /dashboard/route/
router.get('/:firstRoute', adminController.getMenuHandler1);

// Admin All Users Page
router.get('/users', adminController.getUsers);

// Show User Details
router.get('/user-details/:userId', adminController.getUserDetails);

// Save User Details or Delete
router.post('/user-details/', adminController.updateUser);

// Export Router to main App
module.exports = router;