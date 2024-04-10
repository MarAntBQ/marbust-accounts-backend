const moduleName = 'dashboard';

const currentUserRole = 3;

const MenuCategory = require('../models/menu_category');


// Show Main Dashboard for accounts
exports.getHome = (req, res, next) => {
  let tempPath = 'home';
  MenuCategory.findAll({
    where: {
      level: 1
    }
  })
    .then(categories => {
      res.render('template', {
        pageTitle: 'Dashboard',
        moduleName: moduleName,
        pagetoLoad: `dashboards/main`,
        moduleSection: `${moduleName}-${tempPath}`,
        cats: categories,
        user_role: currentUserRole
      });
    })
    .catch(err => console.log(err));
}

// Get /dashboard/route1/
exports.getMenuHandler1 = (req, res, next) => {
  const firstRoute = req.params.firstRoute;
  let tempPath = 'home';
  MenuCategory.findAll({
    where: {
      url: `/dashboard/${firstRoute}/`
    }
  })
    .then(optionFound => {
      if (!optionFound || optionFound.length === 0) {
        next();
      }
      console.log(optionFound)
      MenuCategory.findAll({
        where: {
          parent_category_id: optionFound[0].id
        }
      })
        .then(categories => {
          if (categories && categories.length > 0) {
            res.render('template', {
              pageTitle: optionFound[0].name,
              moduleName: moduleName,
              pagetoLoad: `dashboards/main`,
              moduleSection: `${moduleName}-${tempPath}`,
              cats: categories,
              user_role: currentUserRole
            });
          } else {
            next();
          }
        })
        .catch(err => console.log(err));
    })
    .catch(err => console.log(err));
}