# Laravel CRUD Application

This is a basic **CRUD application** built using the **Laravel PHP framework**, utilizing **MySQL** for database management and running locally with **XAMPP**.

---

## 🔧 Features

- Full CRUD operations (Create, Read, Update, Delete)
- Clean MVC structure using Laravel
- Blade templating engine for views
- MySQL database integration

---

## 📦 Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) installed and Apache/MySQL running
- [Composer](https://getcomposer.org/) installed globally
- PHP 8.0+ installed (included with XAMPP)
- Git (optional but recommended)

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/CRUD_In_Laravel.git
cd CRUD_In_Laravel

### 2. Install Dependencies
composer install

### 3. Copy and Configure Environment File
cp .env.example .env

# Then edit the .env file with your database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_user_name
DB_PASSWORD=your_password

### 4. Generate App Key
php artisan key:generate

### 5. Run Migrations
php artisan migrate

### 6. Start the Local Development Server
php artisan serve

# The application will be available at:
http://localhost:8000/products
