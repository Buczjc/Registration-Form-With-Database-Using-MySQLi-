# PHP Registration and Login System

This is a simple PHP-based registration and login system. Users can register with a username and password, log in, and log out.

## Features

- User registration with username and password
- User login with session management
- User logout
- Basic input validation and sanitation

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/Buczjc/Registration-Form-With-Database-Using-MySQLi-
    cd https://github.com/Buczjc/Registration-Form-With-Database-Using-MySQLi-
    ```

2. **Set up your environment:**

    Make sure you have PHP and a web server (like Apache or Nginx) installed on your machine.

3. **Start your web server:**

    If you are using the built-in PHP server for development, you can start it with the following command:

    ```bash
    php -S localhost:8000
    ```

4. **Open your browser:**

    Navigate to `http://localhost:8000` to see the registration form.

## Usage

1. **Registration:**

    - Go to the registration page (`register_path.php`).
    - Enter a username and password to register.

2. **Login:**

    - After registering, go to the login page (`login_path.php`).
    - Enter your username and password to log in.

3. **Logged-in page:**

    - After logging in, you will be redirected to the `logged.php` page, which will welcome you.

4. **Logout:**

    - Click the "Log-Out" link on the `logged.php` page to log out and be redirected back to the registration page.

## Project Structure
Registration-Form-With-Database-Using-MySQLi-/
├── register_path.php
├── login_path.php
├── logged.php
├── README.md
└── other necessary files...
