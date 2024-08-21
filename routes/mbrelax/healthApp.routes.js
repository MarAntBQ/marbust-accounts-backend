const express = require('express');
const healthAppController = require('../../controllers/mbrelax/healthApp.controller');
const router = express.Router();


router.get('/questions/:gender', healthAppController.getQuestionsByGender);
router.get('/systems', healthAppController.getSystems);

module.exports = router;