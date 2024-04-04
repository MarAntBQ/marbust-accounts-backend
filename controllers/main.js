const moduleName = 'main';

// Show Home Page
exports.getHome = (req, res, next) => {
  let tempPath = 'home';
  res.render('template', {
    pageTitle: 'Welcome',
    moduleName: moduleName,
    pagetoLoad: `${moduleName}/${tempPath}`,
    moduleSection: `${tempPath}`,
  });
}