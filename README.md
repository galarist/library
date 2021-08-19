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
    │       │   └── t9i-edit-book-covers-online.jpg
    │       └── favicon.ico
    ├── README.md
    ├── resources
    │   └── library.sql
    ├── users
    │   ├── dashboard.php
    │   ├── signin.php
    │   ├── signout.php
    │   └── signup.php
    └── view
        ├── footer.php
        └── header.php

## Extra Details:
* In the _**signin.php**_ file the PDO connection using **`admin`** for both **username** and **password** to connect to the localhost database