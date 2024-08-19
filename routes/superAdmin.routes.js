const express = require('express');
const superAdminController = require('../controllers/superAdmin.controller');
const checkSuperAdminRole = require('../middleware/checkSuperAdmin.middleware');
const router = express.Router();

router.get('/roles', checkSuperAdminRole, superAdminController.getAllRoles);
router.get('/users', checkSuperAdminRole, superAdminController.getAllUsers);

module.exports = router;