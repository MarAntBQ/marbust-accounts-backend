const express = require('express');
const USER_ROLE = require('../enums/role.enum');

const superAdminController = require('../controllers/superAdmin.controller');
const checkAccessMiddleware = require('../middleware/checkAccess.middleware');
const router = express.Router();


router.get('/roles', checkAccessMiddleware(USER_ROLE.SUPER_ADMIN), superAdminController.getAllRoles);
router.get('/users', checkAccessMiddleware(USER_ROLE.SUPER_ADMIN), superAdminController.getAllUsers);


module.exports = router;