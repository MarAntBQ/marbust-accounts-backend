const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const config = require('../config');
const sendEmail = require('../services/sendEmail.service');

const Role = require('../models/role.model');
const USER_STATUS = require('../enums/userStatus.enum');
const User = require('../models/user.model');
const UserCredential = require('../models/userCredential.model');


const generateOtpCode = () => {
    return Math.floor(100000 + Math.random() * 900000).toString();
};

const generateTemporaryPassword = () => {
    return Math.random().toString(36).slice(-8);
};

exports.register = async (req, res) => {
    try {
        const { firstName, lastName, email, phone, password } = req.body;
        const otpCode = generateOtpCode();
        // Verify if user already exists
        const existingUser = await User.findOne({ where: { email } });
        if (existingUser) {
            return res.status(400).json({ error: 'Usuario ya registrado' });
        }

        // Create user
        const user = await User.create({
            firstName,
            lastName,
            email,
            phone,
            otpCode,
            otpTries: 0
        });

        // Encrypt password and insert into UserCrential table
        const hashedPassword = await bcrypt.hash(password, 12);
        await UserCredential.create({ userId: user.id, password: hashedPassword });

        // Send OTP to user
        const emailSubject = `Creación de cuenta - Verificación OTP [${otpCode}]`;
        const emailBody = `¡Bienvenido a <strong>Marbust Accounts</strong>! Tu cuenta ha sido creada exitosamente.
        <br>
        Por favor verifica tu dirección de correo electrónico ingresando el siguiente código OTP: <strong>${otpCode}</strong> en la página de verificación.
        <br>
        Link de verificación: <a href="${config.urls.frontend}/confirm-otp">Verificar OTP</a>
        `;
        await sendEmail(email, emailSubject, emailBody);
        res.status(201).json({ message: 'Usuario registrado con éxito' });
    } catch (error) {
        res.status(500).json({ error: 'Error procesando la solicitud', serverReport: error });
    }
};

exports.verifyOtp = async (req, res) => {
    try {
        const { email, otpCode } = req.body;

        // Check if user exists
        const user = await User.findOne({ where: { email } });
        if (!user) {
            return res.status(404).json({ error: 'Usuario no existe.' });
        }

        // If account is suspended, return error not able to verify OTP or generate new OTP
        if (user.statusId === USER_STATUS.SUSPENDED) {
            return res.status(403).json({ error: 'El usuario se encuentra suspendido.' });
        }

        // Check if OTP tries exceed the limit
        if (user.otpTries >= 3 || !user.otpCode) {
            const newOtpCode = generateOtpCode();
            user.otpCode = newOtpCode;
            user.otpTries = 0;
            await user.save();
            // Send OTP to user
            const emailSubject = `Verificación OTP [${newOtpCode}]`;
            const emailBody = `Tu nuevo código OTP es: <strong>${newOtpCode}</strong>`;
            await sendEmail(email, emailSubject, emailBody);
            return res.status(400).json({ error: 'Código OTP ha expirado. Un nuevo código OTP ha sido enviado.' });
        }

        // Check if OTP is correct
        if (user.otpCode !== otpCode) {
            user.otpTries += 1;
            await user.save();
            // Send OTP to user
            const emailSubject = `Verificación OTP [${user.otpCode}]`;
            const emailBody = `Tu código OTP es: <strong>${user.otpCode}</strong>. Recuerda que tienes <strong>${3 - user.otpTries}</strong> intento/s más para verificar tu cuenta.`;
            await sendEmail(email, emailSubject, emailBody);
            return res.status(400).json({ error: `Código OTP invalido. Recuerda que tienes ${3 - user.otpTries} intento/s más para verificar tu cuenta.` });
        }

        // Activate user
        user.statusId = USER_STATUS.ACTIVE;
        user.otpCode = null;
        user.otpTries = 0;
        await user.save();

        const emailSubject = 'Cuenta Activada';
        const emailBody = `Felicitaciones, tu cuenta ha sido activada.`;
        await sendEmail(email, emailSubject, emailBody);

        res.status(200).json({ message: 'Activación de usuario con éxito.' });
    } catch (error) {
        res.status(500).json({ error: 'Error procesando la solicitud', serverReport: error });
    }
};

exports.login = async (req, res) => {
    try {
        const { email, password } = req.body;

        // Check if user exists
        const user = await User.findOne({
            where: { email },
            include: {
                model: Role,
                attributes: ['name']
            }
        });

        if (!user) {
            return res.status(401).json({ error: 'Usuario no existe.' });
        }

        // Check if password is correct
        const userCredential = await UserCredential.findOne({ where: { userId: user.id } });
        let isPasswordValid = false;
        let resetLogged = false;

        // Check if tempPassword exists
        if (userCredential.tempPassword) {
            isPasswordValid = await bcrypt.compare(password, userCredential.tempPassword);
            if (isPasswordValid) {
                userCredential.tempPassword = null;
                const hashedPassword = await bcrypt.hash(password, 12);
                userCredential.password = hashedPassword;
                resetLogged = true;
            }
        }

        // If tempPassword is not valid or doesn't exist, check the normal password
        if (!isPasswordValid) {
            isPasswordValid = await bcrypt.compare(password, userCredential.password);
            userCredential.tempPassword = null;
        }

        if (!isPasswordValid) {
            return res.status(401).json({ error: 'Contraseña Incorrecta.' });
        }

        if (user.statusId !== USER_STATUS.ACTIVE) {
            let userStatus = '';
            switch (user.statusId) {
                case USER_STATUS.ACTIVE:
                    userStatus = 'activa';
                    break;
                case USER_STATUS.INACTIVE:
                    userStatus = 'inactiva, verifica tu correo electrónico para activar tu cuenta';
                    break;
                case USER_STATUS.SUSPENDED:
                    userStatus = 'suspendidad';
                    break;
                default:
                    userStatus = 'activa';
            }
            if (user.statusId === USER_STATUS.INACTIVE) {
                const emailSubject = `Necesitas verificar tu correo electrónico`;
                const emailBody = `¡Bienvenido a <strong>Marbust Accounts</strong>! Tu cuenta ha sido creada exitosamente.
                <br>
                Por favor verifica tu dirección de correo electrónico ingresando el siguiente código OTP: <strong>${user.otpCode}</strong> en la página de verificación.
                <br>
                Link de verificación: <a href="${config.urls.frontend}/confirm-otp">Verificar OTP</a>
                `;
                await sendEmail(email, emailSubject, emailBody);
            }
            return res.status(403).json({
                status: {
                    id: user.statusId,
                    name: userStatus
                },
                error: `Tu cuenta de usuario está ${userStatus}.`
            });
        }

        // Generate token
        const token = jwt.sign({ userId: user.id, roleId: user.roleId },  config.jwtSecret, { expiresIn: '1h' });

        const emailSubject = 'Notificación de inicio de sesión';
        const emailBody = `Tu cuenta ha iniciado sesión el <strong>${new Date().toLocaleString()}</strong> desde la dirección IP <strong>${req.ip}</strong>`;
        await sendEmail(email, emailSubject, emailBody);

        await userCredential.save();

        const data = {
            id: user.id,
            firstName: user.firstName,
            lastName: user.lastName,
            email: user.email,
            phone: user.phone,
            role: user.Role.name,
            roleId: user.roleId
        };

        res.status(200).json({
            user: data,
            message: "¡Inicio de sesión exitoso!",
            token: token
        });
    } catch (error) {
        res.status(500).json({ error: 'Error procesando la solicitud', serverReport: error });
    }
};

// Request Recover password
exports.requestPasswordReset = async (req, res) => {
    try {
        const { email } = req.body;

        // Find user by email
        const user = await User.findOne({ where: { email } });
        if (!user) {
            return res.status(404).json({ error: 'Usuario no éxiste' });
        }

        // Generate temporary password
        const temporaryPassword = generateTemporaryPassword();

        // Encrypt temporary password
        const hashedPassword = await bcrypt.hash(temporaryPassword, 12);

        // Update user password
        await UserCredential.update({ tempPassword: hashedPassword }, { where: { userId: user.id } });

        // Send temporary password to user
        const emailSubject = 'Recuperación de contraseña';
        const emailBody = `Tu contraseña temporal es: <strong>${temporaryPassword}</strong>
        <br>Si no solicitaste esto, ignora este correo electrónico. Tu contraseña será protegida y la contraseña temporal eliminada después de iniciar sesión con tus credenciales actuales.
        <br>Recuerda que tu contraseña será cambiada si inicias sesión con <strong>esta contraseña temporal</strong>, por lo que te recomendamos que cambies tu contraseña`;
        await sendEmail(user.email, emailSubject, emailBody);

        res.status(200).json({ message: 'Contraseña Temporal ha sido enviada a su correo' });
    } catch (error) {
        res.status(500).json({ error: 'Error procesando la solicitud', serverReport: error });
    }
};

exports.changePassword = async (req, res) => {
    try {
        const { newPassword } = req.body;
        const userId = req.userId;

        // Encrypt new password
        const hashedNewPassword = await bcrypt.hash(newPassword, 12);

        // Update user password
        await UserCredential.update({ password: hashedNewPassword }, { where: { userId } });

        // Get User email
        const user = await User.findOne({ where: { id: userId }, attributes: ['email'] });

        // Send temporary password to user
        const emailSubject = 'Cambio de contraseña';
        const emailBody = `Tu contraseña ha sido cambiada, tu nueva contraseña es: <strong>${newPassword}</strong>`;
        await sendEmail(user.email, emailSubject, emailBody);

        res.status(200).json({
            newPassword: newPassword,
            message: 'Cambio de contraseña con éxito.'
        });
    } catch (error) {
        res.status(500).json({ error: 'Error procesando la solicitud', serverReport: error });
    }
};

exports.getProfile = async (req, res, next) => {
    try {
        const user = await User.findByPk(req.userId, {
            attributes: ['id', 'firstName', 'lastName', 'email', 'phone', 'roleId'],
            include: {
                model: Role,
                attributes: ['name']
            }
        });
        if (!user) {
            return res.status(404).json({ error: 'Usuario no encontrado.' });
        }
        const data = {
            id: user.id,
            firstName: user.firstName,
            lastName: user.lastName,
            email: user.email,
            phone: user.phone,
            role: user.Role.name,
            roleId: user.roleId
        };

        res.status(200).json(data);
    } catch (err) {
        console.log(err);
        res.status(500).json({ error: 'Error procesando la solicitud', serverReport: error });
    }
};

exports.jwtCheck = async (req, res, next) => {
    return res.status(200).json({
        verified: true,
        message: 'Token válido'
    });
}