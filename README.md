# library
## Folder Structure:
    .
    ├── controller
    │   ├── create.php
    │   ├── delete.php
    │   ├── read.php
    │   └── update.php
    ├── index.php
    ├── model
    │   └── conn.php
    ├── public
    │   ├── css
    │   │   └── style.css
    │   └── img
    │       ├── covers
    │       │   └── default.jpg
    │       └── favicon.ico
    ├── README.md
    ├── resources
    │   └── library.sql
    ├── users
    │   ├── dashboard.php
    │   ├── signin.php
    │   ├── signout.php
    │   └── signup.php
    ├── view
    │   ├── footer.php
    │   └── header.php
    ├── README.md
    └── index.php

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