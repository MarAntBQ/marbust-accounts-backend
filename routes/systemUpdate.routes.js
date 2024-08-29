const express = require('express');
const systemUpdateController = require('../controllers/systemUpdate.controller');
const USER_ROLE = require('../enums/role.enum');
const checkAccessMiddleware = require('../middleware/checkAccess.middleware');
const router = express.Router();

router.get('/view-all', systemUpdateController.viewAll);
router.post('/create', checkAccessMiddleware(USER_ROLE.ADMIN), systemUpdateController.createNew);

module.exports = router;