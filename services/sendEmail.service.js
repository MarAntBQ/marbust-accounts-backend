const nodemailer = require('nodemailer');
const config = require('../config');

const transporter = nodemailer.createTransport({
    host: config.nodemailer.host,
    port: config.nodemailer.port,
    secure: config.nodemailer.secure,
    auth: {
        user: config.nodemailer.user,
        pass: config.nodemailer.password
    }
});

const sendEmail = async (emailTo, emailSubject, emailBody) => {
    try {
        const mailOptions = {
            from: config.nodemailer.user,
            to: emailTo,
            subject: `${emailSubject} | ${config.appName} System`,
            html: `
                <h1 style='text-align: center;'>${emailSubject}</h1>
                <hr />
                ${emailBody}
                <hr />
                <p style='text-align: center;'><strong>${config.appName}&reg;</strong> System </br>&copy; ${new Date().getFullYear()} <a href="https://marbust.com" style="font-weight: bold;">Marbust Technology Company</a> - All Rights Reserved</p>
            `
        };
        const info = await transporter.sendMail(mailOptions);
        console.log(`Email was sent to: ${emailTo} with Id: ${info.response}`);
    } catch (error) {
        console.log(error);
    }
}

module.exports = sendEmail;