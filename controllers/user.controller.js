const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const config = require('../config');

const Role = require('../models/role.model');
const USER_STATUS = require('../enums/userStatus.enum');
const User = require('../models/user.model');
const UserCredential = require('../models/userCredential.model');


const generateOtpCode = () => {
    return Math.floor(100000 + Math.random() * 900000).toString();
};

exports.register = async (req, res) => {
    try {
        const { firstName, lastName, email, phone, password } = req.body;
        const otpCode = generateOtpCode();
        // Verify if user already exists
        const existingUser = await User.findOne({ where: { email } });
        if (existingUser) {
            return res.status(400).json({ error: 'User already exists' });
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

        res.status(201).json({ message: 'User registered successfully' });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.verifyOtp = async (req, res) => {
    try {
        const { email, otpCode } = req.body;

        // Check if user exists
        const user = await User.findOne({ where: { email } });
        if (!user) {
            return res.status(404).json({ message: 'User not found.' });
        }

        // Check if OTP tries exceed the limit
        if (user.otpTries >= 3) {
            const newOtpCode = generateOtpCode();
            user.otpCode = newOtpCode;
            user.otpTries = 0;
            await user.save();
            return res.status(400).json({ message: 'OTP expired. A new OTP has been sent.' });
        }

        // Check if OTP is correct
        if (user.otpCode !== otpCode) {
            user.otpTries += 1;
            await user.save();
            return res.status(400).json({ message: 'Invalid OTP.' });
        }

        // Activate user
        user.statusId = USER_STATUS.ACTIVE;
        user.otpCode = null;
        user.otpTries = 0;
        await user.save();

        res.status(200).json({ message: 'User activated successfully.' });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.login = async (req, res) => {
    try {
        const { email, password } = req.body;

        // Check if user exists
        const user = await User.findOne({ where: { email } });
        if (!user) {
            return res.status(401).json({ message: 'User not found.' });
        }

        // Check if password is correct
        const userCredential = await UserCredential.findOne({ where: { userId: user.id } });
        const isPasswordValid = await bcrypt.compare(password, userCredential.password);
        if (!isPasswordValid) {
            return res.status(401).json({ message: 'Wrong password.' });
        }

        if (user.statusId !== USER_STATUS.ACTIVE) {
            let userStatus = '';
            switch (user.statusId) {
                case USER_STATUS.ACTIVE:
                    userStatus = 'active';
                    break;
                case USER_STATUS.INACTIVE:
                    userStatus = 'inactive';
                    break;
                case USER_STATUS.SUSPENDED:
                    userStatus = 'suspended';
                    break;
                default:
                    userStatus = 'active';
            }
            return res.status(403).json({
                status: {
                    id: user.statusId,
                    name: userStatus
                },
                message: `User account is ${userStatus}. Please contact admin`
            });
        }

        // Generate token
        const token = jwt.sign({ userId: user.id, roleId: user.roleId },  config.jwtSecret, { expiresIn: '1h' });

        res.status(200).json({ token });
    } catch (error) {
        res.status(500).json({ error: error.message });
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
            return res.status(404).json({ message: 'User not found.' });
        }
        const userReponse = {
            id: user.id,
            firstName: user.firstName,
            lastName: user.lastName,
            email: user.email,
            phone: user.phone,
            role: user.Role.name
        };

        res.status(200).json({ userReponse });
    } catch (err) {
        console.log(err);
        res.status(500).json({ message: 'Fetching profile failed.' });
    }
};