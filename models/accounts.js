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
  constructor(name, email, password, phone) {
    this.name = name;
    this.email = email;
    this.password = password;
    this.phone = phone;
  }

  save() {
    this.id = Math.random().toString();
    getUsersFromFile(users => {
      // We are pushing this class
      users.push(this);
      fs.writeFile(p, JSON.stringify(users), (err) => {
        console.log(err);
      });
    });
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

  static updateById(id, name, email, phone) {
    getUsersFromFile(users => {
      const checkIndex = users.findIndex(u => u.id === id);
      if (checkIndex !== -1) {
        let updatedUser = { ...users[checkIndex] }
        updatedUser.name = name;
        updatedUser.email = email;
        updatedUser.phone = phone;

        users[checkIndex] = updatedUser;
        fs.writeFile(p, JSON.stringify(users), err => {
          console.log(err);
        });
      }
    });
  }
}