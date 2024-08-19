const express = require('express');
const bodyParser = require('body-parser');
const sequelize = require('./util/database');
const config = require('./config');
const authMiddleware = require('./middleware/auth.middleware');

// Importar rutas de usuarios
const defaultRoutes = require('./routes/default.routes');
const userRoutes = require('./routes/user.routes');
const superAdminRoutes = require('./routes/superAdmin.routes');

const app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// Usar rutas de usuarios
app.use('/api', defaultRoutes);
app.use('/api', userRoutes);
app.use('/api/superadmin', authMiddleware, superAdminRoutes);

// Sincronizar base de datos y levantar servidor
sequelize.sync()
    .then(() => {
        app.listen(config.server.port, () => {
            console.log(`Server is running on port ${config.server.port}`);
        });
    })
    .catch(err => {
        console.log(err);
    });