<p align="center">
  <h3 align="center">Simple Ecommerce</h3>

  <p align="center">
    Build a simple ecommerce website with Laravel.
    <br />
    <a href="https://github.com/hiskiapp/simple-ecommerce"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/hiskiapp/simple-ecommerce">View Demo</a>
    ·
    <a href="https://github.com/hiskiapp/simple-ecommerce/issues">Report Bug</a>
    ·
    <a href="https://github.com/hiskiapp/simple-ecommerce/issues">Request Feature</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
## Table of Contents

* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [To Do List](#to-do-list)
* [Acknowledgements](#acknowledgements)

### Built With
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)
* [Laravel](https://laravel.com)



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites
-   PHP Version 7.4 or Above
-   Composer
-   Git
-   NPM

### Installation

1. Open the terminal, navigate to your directory (htdocs or public_html).
```bash
git clone https://github.com/hiskiapp/simple-ecommerce.git
cd simple-ecommerce
composer install
npm install && npm run dev
cp .env.example .env
```

2. Setting the database, smtp configuration, open .env file at project root directory
```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_MAILER=
MAIL_HOST=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"
```

3. Install Project
```bash
php artisan key:generate
php artisan migrate --seed
php artisan optimize
```
You will get the administrator credential and url access like example bellow:
```bash
::Administrator Credential::
URL Login: http://localhost/simple-ecommerce/public/admin/login
Email: hi@hiskia.app
Password: 123456
```

### To Do List

- [x] Initializing Template
- [x] Migration
- [x] Admin Auth
- [x] All Admin CRUD (Admins, Users, Transactions, Products, Categories, Payment Methods, Settings)
- [x] User Auth
- [x] User Dashboard
- [x] Cart Page
- [x] Checkout Page
- [x] User Transactions

<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements
* [Laravel](https://laravel.com)
