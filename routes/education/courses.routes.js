const express = require('express');
const authMiddleware = require('../../middleware/auth.middleware');
const checkAccessMiddleware = require('../../middleware/checkAccess.middleware');
const coursesController = require('../../controllers/education/courses.controller');

const router = express.Router();

//router.post('/create', checkAccessMiddleware(USER_ROLE.ADMIN), coursesController.createNew);

module.exports = router;