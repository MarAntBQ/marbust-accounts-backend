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
  let userFirstName = req.body.first_name;
  let userLastName = req.body.last_name;
  let userEmail = req.body.email;
  let userPhone = req.body.phone;
  let userPassword = req.body.password;

  if (req.body.form_action == 'register') {
    const account = new Account(null, userFirstName, userLastName, userEmail, userPhone, userPassword, 1);
    account
    .save()
    .then(() => {
      res.redirect('/account-setup/login');
    })
    .catch(err => console.log(err));
  } else if (req.body.form_action == 'login') {
    res.redirect('/dashboard');
  } else {
    res.redirect('/');
  }
}