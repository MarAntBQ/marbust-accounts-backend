// Accounts Controller

// Import Accounts Model
const Account = require('../models/accounts');

const moduleName = 'account-setup';

// Show Register Page
exports.getRegister = (req, res, next) => {
  let tempPath = 'register';
  res.render('template', {
    pageTitle: 'Create an Account',
    moduleName: moduleName,
    pagetoLoad: `${moduleName}/${tempPath}`,
    moduleSection: `${moduleName}-${tempPath}`,
  });
}

// Show Login Page
exports.getLogin = (req, res, next) => {
  let tempPath = 'login';
  res.render('template', {
    pageTitle: 'Login',
    moduleName: moduleName,
    pagetoLoad: `${moduleName}/${tempPath}`,
    moduleSection: `${moduleName}-${tempPath}`,
  });
}

// Logout Logic
exports.logoutSettings = (req, res, next) => {
  res.redirect('/');
}

// Accounts Login for both Login and Registration
exports.accountsSetup = (req, res, next)=> {
  let userName = req.body.name;
  let userEmail = req.body.email;
  let userPassword = req.body.password;
  let userPhone = req.body.phone;

  if (req.body.form_action == 'register') {
    const account = new Account(null, userName, userEmail, userPassword, userPhone);
    account.save();
    res.redirect('/account-setup/login');
  } else if (req.body.form_action == 'login') {
    res.redirect('/dashboard');
  } else {
    res.redirect('/');
  }
}