// Accounts Controller

// Import Accounts Model
const User = require('../models/user');
const Item = require('../models/item');
const ItemCategory = require('../models/item_category');
const MenuOption = require('../models/menu_option');
const Role = require('../models/role');
const ItemUserCategory = require('../models/item-user-category');

const moduleName = 'account-setup';



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
    User.create({
      first_name: userFirstName,
      last_name: userLastName,
      email: userEmail,
      phone: userPhone,
      password: userPassword,
      level_id: 1
    })
    .then(() => {
      res.redirect('/account-setup/login');
    })
    .catch(err => console.log(err));
    
    // id: {
    //   type: Sequelize.INTEGER,
    //   autoIncrement: true,
    //   allowNull: false,
    //   primaryKey: true
    // },
    // first_name: Sequelize.STRING,
    // last_name: Sequelize.STRING,
    // email: Sequelize.STRING,
    // password: Sequelize.STRING,
    // level_id: Sequelize.INTEGER,
    
    // const account = new Account(null, userFirstName, userLastName, userEmail, userPhone, userPassword, 1);
    // account
    // .save()
    // .then(() => {
    //   res.redirect('/account-setup/login');
    // })
    // .catch(err => console.log(err));
  } else if (req.body.form_action == 'login') {
    res.redirect('/dashboard');
  } else {
    res.redirect('/');
  }
}