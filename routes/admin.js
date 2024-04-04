const express = require('express');

const adminController = require('../controllers/admin');

const router = express.Router();

// Admin Home Page
router.get('/', adminController.getHome);

// Admin All Users Page
router.get('/users', adminController.getUsers);

// Show User Details
router.get('/user-details/:userId', adminController.getUserDetails);

// Save User Details
router.post('/user-details/', adminController.updateUser);

// Export Router to main App
module.exports = router;