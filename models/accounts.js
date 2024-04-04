// Accounts Model

// Import filesystem and path to have access to it
const fs = require('fs');
const path = require('path');

// Setting a path using the extension
const p = path.join(path.dirname(require.main.filename),
'data',
'users.json'
);

// Function to read the file
const getUsersFromFile = (cb) => {
  fs.readFile(p, (err, fileContent) => {
    if (err) {
      cb([]);
    } else {
      cb(JSON.parse(fileContent));
    }
  });
}


// Create Class and export it to make it available outside this file
module.exports = class UserAccount {
  constructor(id, name, email, password, phone) {
    this.id = id;
    this.name = name;
    this.email = email;
    this.password = password;
    this.phone = phone;
  }

  save() {
    getUsersFromFile(users => {
      if (this.id) {
        const existingUserIndex = users.findIndex(u => u.id === this.id);
        const updatedUsers = [...users];
        let pastPassword = updatedUsers[existingUserIndex].password;
        this.password = pastPassword;
        updatedUsers[existingUserIndex] = this;
        fs.writeFile(p, JSON.stringify(updatedUsers), (err) => {
          console.log(err);
        });
      } else {
        this.id = Math.random().toString();
        // We are pushing this class
        users.push(this);
        fs.writeFile(p, JSON.stringify(users), (err) => {
          console.log(err);
        });
      }
    });
  }
  static deleteUserById(id) {
    getUsersFromFile(users => {
      const existingUserIndex = users.findIndex(u => u.id === id);
      users.splice(existingUserIndex, 1);
      fs.writeFile(p, JSON.stringify(users), (err) => {
        console.log(err);
      });
    });
  }
  static getUsersCount(cb) {
    getUsersFromFile(users => {
      cb(users.length);
    })
  }
  // Creating a call back
  static fetchAll(cb) {
    getUsersFromFile(cb);
  }

  static findById(id, cb) {
    getUsersFromFile(users => {
      const user = users.find(u => u.id === id)
      cb(user);
    });
  }
}