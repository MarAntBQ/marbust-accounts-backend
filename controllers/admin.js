const moduleName = 'admin';

// Import Accounts Model
const Account = require('../models/accounts');


// Show Admin Dashboard
exports.getHome = (req, res, next) => {
  let tempPath = 'home';
  Account.getUsersCount(count => {
    res.render('template', {
      pageTitle: 'Admin Dashboard',
      moduleName: moduleName,
      pagetoLoad: `${moduleName}/${tempPath}`,
      moduleSection: `${moduleName}-${tempPath}`,
      totalusers: count
    });
  })
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

// Post Update User or Delete User
exports.updateUser = (req, res, next)=> {
  // Getting data from the form
  let userId = req.body.id;
  
  if (req.body.form_action == 'edit') {
    let updatedName = req.body.name;
    let updatedEmail = req.body.email;
    let updatedPhone = req.body.phone;
    const updatedUser = new Account(userId, updatedName, updatedEmail, null, updatedPhone);
    updatedUser.save();
    res.redirect('/admin/users');
  } if (req.body.form_action == 'delete') {
    Account.deleteUserById(userId);
    res.redirect('/admin/users');
  } else {
    res.redirect('/');
  }
}