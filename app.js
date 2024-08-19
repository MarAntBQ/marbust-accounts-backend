const express = require('express');
const bodyParser = require('body-parser');
const sequelize = require('./util/database.util');
const config = require('./config');
const authMiddleware = require('./middleware/auth.middleware');

// Import Routes
const defaultRoutes = require('./routes/default.routes');
const userRoutes = require('./routes/user.routes');
const superAdminRoutes = require('./routes/superAdmin.routes');

const app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// App Routes
app.use('/api', defaultRoutes);
app.use('/api', userRoutes);
app.use('/api/superadmin', authMiddleware, superAdminRoutes);

// Sync Database and start server
sequelize.sync({ alter: true })
    .then(() => {
        app.listen(config.server.port, () => {
            console.log(`Server is running on port ${config.server.port}`);
        });
    })
    .catch(err => {
        console.log(err);
    });