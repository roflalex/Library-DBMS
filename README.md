# Library DBMS

A simple PHP-based library management system that uses a MySQL database to handle user accounts, book searching, reservations, and reservation tracking.

## Overview

This project is a web application for managing a small library system. Users can:

- register for an account
- log in securely to the system
- search for books by title/author or category
- reserve available books
- view their current reservations
- remove reservations when no longer needed

The application is built with PHP and uses MySQL as the relational database backend.

## Tech Stack

- PHP
- MySQL
- HTML/CSS/JavaScript
- MariaDB/MySQL server through XAMPP, WAMP, or a local MySQL setup
- PHP MySQLi extension

## Database Usage

The project relies on a MySQL database named `library`.

The database connection is configured in `database/db_connect.php`:

```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);
```

This means the app expects a running MySQL server on `localhost` and a database named `library` with the tables used by the application, including data for:

- users
- books
- categories
- reservedbooks

The database layer is used for all core operations such as:

- user authentication during login
- creating new accounts
- querying book data
- updating reservation status
- inserting reservation records
- deleting reservations

## Project Structure

```text
Library-DBMS/
├── database/
│   └── db_connect.php
├── pages/
│   ├── index.php
│   ├── login.php
│   ├── register.php
│   ├── search.php
│   ├── reserve.php
│   ├── reservedlist.php
│   ├── delete.php
│   └── logout.php
├── css/
│   └── style.css
├── scripts/
│   └── script.js
└── README.md
```

## Setup Instructions

### 1. Install and start MySQL

Use a local PHP development environment such as:

- XAMPP
- WAMP
- MAMP

Make sure both Apache and MySQL are running.

### 2. Create the database

In MySQL, create a database named `library`:

```sql
CREATE DATABASE library;
USE library;
```

Then create the needed tables for users, books, categories, and reservations according to your library data model.

### 3. Configure the app

Update the connection values in `database/db_connect.php` if your MySQL credentials differ from the default local setup:

```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";
```

### 4. Run the application

Place the project in your web server root (for example, `htdocs` in XAMPP) and open it in the browser:

```text
http://localhost/Library-DBMS/pages/index.php
```

## Features

- User registration and login
- Search books by title/author or category
- Book reservation functionality
- Reservation list display
- Reservation cancellation support
- Database-driven persistent storage for all library records

## Notes

This project demonstrates how a web application can work with a relational database to manage real-world data. The MySQL database is central to the application, storing user information and the library catalog as well as reservation records.

This is a beginner-friendly library system project that shows the practical use of PHP and MySQL together for database-backed web development.
