const express = require('express');
const superAdminController = require('../controllers/superAdmin');
const checkSuperAdminRole = require('../middleware/checkSuperAdminRole');
const router = express.Router();

router.get('/roles', checkSuperAdminRole, superAdminController.getAllRoles);
router.get('/users', checkSuperAdminRole, superAdminController.getAllUsers);

module.exports = router;