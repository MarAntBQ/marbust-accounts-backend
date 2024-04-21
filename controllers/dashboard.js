const moduleName = 'dashboard';

// Show Main Dashboard for accounts
exports.getHome = (req, res, next) => {
  let tempPath = 'home';
  res.render('template', {
    pageTitle: 'Last Updates',
    moduleName: moduleName,
    pagetoLoad: `${moduleName}/${tempPath}`,
    moduleSection: `${moduleName}-${tempPath}`
  });
}