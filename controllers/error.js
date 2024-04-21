// Exports both 404 and 500 Errors

// Show 404 Page
exports.get404Page = (req, res, next) => {
  let tempPath = '404';
  let moduleName = 'main';
  res.status(404).render('not-auth', {
    pageTitle: 'Upps! Page not found',
    pageIcon: '<i class="fa-solid fa-ban"></i>',
    moduleName: moduleName,
    pagetoLoad: `${moduleName}/${tempPath}`,
    moduleSection: `${tempPath}`,
  });
}