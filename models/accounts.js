// Accounts Model
// Import DB Connector
const db = require('../util/database');
// Create Class and export it to make it available outside this file
module.exports = class UserAccount {
  constructor(id, first_name, last_name, email, phone, password, level_id) {
    this.id = id;
    this.first_name = first_name;
    this.last_name = last_name;
    this.email = email;
    this.phone = phone;
    this.password = password;
    this.level_id = level_id;
  }

  save() {
    return db.execute(`INSERT INTO users (first_name, last_name, email, phone, password, level_id) VALUES (?,?,?,?,?,?)`,
    [this.first_name, this.last_name, this.email, this.phone, this.password, this.level_id]);
  }
  static deleteUserById(id) {
    return db.execute('DELETE FROM users WHERE id = ?', [id]);
  }
  static getUsersCount() {
    return db.execute('SELECT COUNT(*) AS total_users FROM users');
  }
  // Creating a call back
  static fetchAll() {
    return db.execute('SELECT * from users');
  }

  static findById(id) {
    console.log(id)
    return db.execute(`SELECT * from users where users.id = ?`,
    [id]
    );
  }
}