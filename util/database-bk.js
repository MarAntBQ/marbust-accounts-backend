const Sequelize = require('sequelize');

let dbHost = {
  local: 'localhost',
  remote: 'IP HOSTING'
}

let url = dbHost.local;

const sequelize = new Sequelize('DATABASE', 'USER', 'PASSWORD', {
  dialect: 'mysql',
  host: url
});

module.exports = sequelize;