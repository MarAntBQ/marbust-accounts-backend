const mysql = require('mysql2');

let dbHost = {
  local: 'localhost',
  remote: 'IP HOSTING'
}

let url = dbHost.local;

const pool = mysql.createPool({
  host: url,
  user: '',
  database: '',
  password: ''
});

module.exports = pool.promise();