const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const sequelize = require('./util/database.util');
const config = require('./config');
const authMiddleware = require('./middleware/auth.middleware');

// Import Routes
const defaultRoutes = require('./routes/default.routes');
const userRoutes = require('./routes/user.routes');
const systemRoutes = require('./routes/system.routes');
const mbrelaxRoutes = require('./routes/mbrelax/healthApp.routes');
const systemUpdateRoutes = require('./routes/systemUpdate.routes');
const marbustEducationCoursesRoutes = require('./routes/education/courses.routes');

const app = express();
// Setup Cors
app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// App Routes
app.use(defaultRoutes);
app.use(userRoutes);
app.use('/system', authMiddleware, systemRoutes);
app.use('/system-updates', authMiddleware, systemUpdateRoutes);
app.use('/mbrelax', mbrelaxRoutes);
app.use('/marbust-education/courses', marbustEducationCoursesRoutes);

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