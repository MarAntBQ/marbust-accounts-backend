// Accounts Controller
const moduleName = 'account-setup';

// Import Accounts Model
const User = require('../models/user');
const Role = require('../models/role');

// Logout Logic
exports.logoutSettings = (req, res, next) => {
  res.redirect('/login');
}
// Register
exports.createAccount = (req, res, next)=> {
  let userFirstName = req.body.first_name;
  let userLastName = req.body.last_name;
  let userEmail = req.body.email;
  let userPhone = req.body.phone;
  let userPassword = req.body.password;
  User.create({
    first_name: userFirstName,
    last_name: userLastName,
    email: userEmail,
    phone: userPhone,
    password: userPassword,
    role_id: 1
  })
  .then(() => {
    res.redirect('/login');
  })
  .catch(err => console.log(err));
}
// Login
exports.loginSetup = (req, res, next)=> {
  let userEmail = req.body.email;
  let userPassword =req.body.password;
  User.findOne({ where: { email: userEmail } })
  .then(user => {
    if (user && user.password == userPassword) {
      res.redirect('/home')
    } else if (user) {
      console.log('Incorrect Password');
      res.redirect('/login');
    } else {
      console.log('User not found');
      res.redirect('/login');
    }
  })
}
// Request password send to email
exports.forgotPasswordSetup = (req, res, next)=> {
  let userEmail = req.body.email;
  User.findOne({ where: { email: userEmail } })
  .then(user => {
    if (user) {
      console.log('Password has been sent to email');
      res.redirect('/login');
    } else {
      console.log('User not found');
      res.redirect('/register');
    }
  })
}