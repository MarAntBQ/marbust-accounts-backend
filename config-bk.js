module.exports = {
    jwtSecret: 'jwtSecretKey',
    whatsApp: {
        url: `whatsAppUrl`,
        keySecret: 'whatsAppSecretKey',
    },
    db: {
        host: 'localhost',
        user: 'DATABASE_USER',
        password: 'DATABASE_PASSWORD',
        database: 'DATABASE_NAME'
    },
    server: {
        port: 3000
    },
    nodemailer: {
        host: 'mail.domain.com',
        port: 465,
        secure: true,
        user: 'MAILTRAP_USER',
        password: 'MAILTRAP_PASSWORD'
    },
    urls: {
        frontendBackup: '',
        frontend: '',
        backend: ''
    }
};