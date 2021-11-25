# library
## Folder Structure:
    .
    ├── index.php
    ├── library.sql
    ├── mvc
    │   ├── controller
    │   │   ├── books.controller.php
    │   │   └── users.controller.php
    │   ├── model
    │   │   ├── books.model.php
    │   │   ├── conn.php
    │   │   └── users.model.php
    │   └── view
    │       ├── books.php
    │       ├── dashboard.php
    │       ├── editBook.php
    │       ├── footer.php
    │       ├── header.php
    │       ├── profile.php
    │       ├── signin.php
    │       └── signup.php
    ├── public
    │   ├── css
    │   │   └── style.css
    │   ├── img
    │   │   ├── covers
    │   │   │   └── default.jpg
    │   │   └── favicon.ico
    │   └── js
    │       └── functions.js
    ├── README.md
    └── resources
        ├── library.sql
        └── tracker
            └── trackedit.md

## Extra Details:
* In the _**conn.php**_ file under the `model` folder, the PDO connection using **`admin`** for both **username** and **password** to connect to the localhost database
* Two ___admin___ users:
    * **John Doe**
        - Username: John
        - Password: admin
        - Permission: 1 (as admin)
    * **Jane Doe** 
        - Username: Jane
        - Password: admin
        - Permission: 1 (as admin)