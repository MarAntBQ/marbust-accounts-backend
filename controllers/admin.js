const moduleName = 'admin';

// Import Accounts Model
const Account = require('../models/accounts');


// Show Admin Dashboard
exports.getHome = (req, res, next) => {
  let tempPath = 'home';
  res.render('template', {
    pageTitle: 'Admin Dashboard',
    moduleName: moduleName,
    pagetoLoad: `${moduleName}/${tempPath}`,
    moduleSection: `${moduleName}-${tempPath}`,
  });
}
// Show Admin -> Users Dashboard
exports.getUsers = (req, res, next) => {
  let tempPath = 'users';
  Account.fetchAll(users => {
    res.render('template', {
      pageTitle: 'Admin Dashboard > Users',
      moduleName: moduleName,
      pagetoLoad: `${moduleName}/${tempPath}`,
      moduleSection: `${moduleName}-${tempPath}`,
      usrs: users
    });
  });
}

// Show Admin -> User Details
exports.getUserDetails = (req, res, next) => {
  const editMode = req.query.edit;
  if (editMode != 'true') {
    res.redirect('/admin/users');
  }
  let tempPath = 'user-details';
  // It's extracting from /user-details/:userId
  const userId = req.params.userId;
  Account.findById(userId, user => {
    if (!user) {
      res.redirect('/admin/users');
    }
    res.render('template', {
      pageTitle: 'Details of ' + user.name,
      moduleName: moduleName,
      pagetoLoad: `${moduleName}/${tempPath}`,
      moduleSection: `${moduleName}-${tempPath}`,
      editing: editMode,
      usr: user
    });
  });
}

// Accounts Login for both Login and Registration
exports.updateUser = (req, res, next)=> {
  let userId = req.body.id;
  let userName = req.body.name;
  let userEmail = req.body.email;
  let userPhone = req.body.phone;

  if (req.body.form_action == 'edit') {
    Account.updateById(userId, userName, userEmail, userPhone);
    res.redirect('/admin/users');
  } else {
    res.redirect('/');
  }
}