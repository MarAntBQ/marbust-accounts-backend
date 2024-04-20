const moduleName = 'main';

// Show Home Page
exports.getHome = (req, res, next) => {
  let tempPath = 'home';
  res.redirect('/login');
}

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
  res.render('not-auth', {
    pageTitle: 'Login',
    moduleName: moduleName,
    pagetoLoad: `${moduleName}/${tempPath}`,
    moduleSection: `${moduleName}-${tempPath}`,
  });
}