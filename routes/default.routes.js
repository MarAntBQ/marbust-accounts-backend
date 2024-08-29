const express = require('express');
const router = express.Router();

router.get('/', (req, res) => {
    // Return a welcome message in JSON format
    res.json({ message: 'Welcome to the Marbust Accounts API 2.5.0' });
});

module.exports = router;