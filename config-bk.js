module.exports = {
    appName: 'Marbust Accounts',
    appVersion: '2.5.0',
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
        frontendBackup: 'URL_LOCAL_REACT',
        frontend: 'URL_REACT_PRODUCTION',
        backend: 'URL_NODEJS_PRODUCTION'
    }
};