const moduleName = 'admin';

// Import Accounts Model
const Account = require('../models/accounts');


// Show Admin Dashboard
exports.getHome = (req, res, next) => {
  let tempPath = 'home';
  Account.getUsersCount().then(([count]) => {
    res.render('template', {
      pageTitle: 'Admin Dashboard',
      moduleName: moduleName,
      pagetoLoad: `${moduleName}/${tempPath}`,
      moduleSection: `${moduleName}-${tempPath}`,
      totalUsers: count[0].total_users
    });
  })
  .catch(err => console.log(err));
}
// Show Admin -> Users Dashboard
exports.getUsers = (req, res, next) => {
  let tempPath = 'users';
  Account.fetchAll()
    .then(([rows, fieldData]) => {
      res.render('template', {
        pageTitle: 'Admin Dashboard > Users',
        moduleName: moduleName,
        pagetoLoad: `${moduleName}/${tempPath}`,
        moduleSection: `${moduleName}-${tempPath}`,
        usrs: rows
      });
    })
    .catch(err => console.log(err));
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

  Account.findById(userId)
    .then(([user]) => {
      if (!user[0]) {
        res.redirect('/admin/users');
      }
      console.log(user)
      res.render('template', {
        pageTitle: 'Details of ' + user[0].first_name,
        moduleName: moduleName,
        pagetoLoad: `${moduleName}/${tempPath}`,
        moduleSection: `${moduleName}-${tempPath}`,
        editing: editMode,
        usr: user[0]
      });
    })
    .catch(err => console.log(err));  
}

// Post Update User or Delete User
exports.updateUser = (req, res, next)=> {
  // Getting data from the form
  let userId = req.body.id;
  
  if (req.body.form_action == 'edit') {
    let updatedName = req.body.name;
    let updatedEmail = req.body.email;
    let updatedPhone = req.body.phone;
    const updatedUser = new Account(userId, userFirstName, userLastName, updatedEmail, updatedPhone, null, 1);
    updatedUser.save();
    res.redirect('/admin/users');
  } if (req.body.form_action == 'delete') {
    Account.deleteUserById(userId)
    .then(() => {
      res.redirect('/admin/users');
    })
    .catch(err => console.log(err));
  } else {
    res.redirect('/');
  }
}