## 🚀 Installation & Setup Guide

### 📦 Requirements

- PHP >= 8.1  
- Composer  
- Laravel >= 10  
- MySQL / MariaDB  
- Node.js & NPM (for frontend assets, optional)

---

### ⚙️ Step-by-step Setup Instructions

1. **Clone the repository**
```bash
- git clone https://github.com/your-username/laravel-blog.git
- cd laravel-blog

2. **Install PHP dependencies**
```bash
- composer install

3. **Copy the .env file and generate app key**
cp .env.example .env
php artisan key:generate

4. **Configure your database in .env**
Open .env and update these lines:
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=your_database_name
- DB_USERNAME=your_database_user
- DB_PASSWORD=your_database_password

5. **Run database migrations**
```bash
php artisan migrate