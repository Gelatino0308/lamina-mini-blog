# WeebYaps

WeebYaps is a vibrant blogging platform designed specifically for anime and manga enthusiasts. It's a community-driven space where otaku culture thrives, allowing users to share their thoughts, reviews, theories, and discussions about their favorite anime series, manga chapters, and Japanese pop culture trends.

## Features

### Blogger Interface
- User authentication
- Commenting system
- Like functionality for posts
- Author page displaying their anime/manga lists
- Cover image upload 
- Filter system by genre based on target audience
- Trending posts and popular discussions
- Tag system for easy content categorization

### Admin Interface
- Admin Dashboard
- Dynamic Role Management
- Post Management and CRUD
- Comment Management

## Technologies Used

### Backend
- **Laravel 11** 
- **PHP 8.1+** 
- **MySQL 8.0** 

### Frontend
- **Blade Templates** 
- **JavaScript (ES6+)**
- **React** 
- **Alpine.js** 
- **Tailwind CSS**
- **Radix UI** 

### Development Environment
- **Composer** 
- **Node.js & NPM** 
- **XAMPP** 

## Setup Steps

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js and NPM
- MySQL 8.0 or higher
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Gelatino0308/lamina-mini-blog
   cd weebyaps
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   ```
   
5. **Configure your .env file**
   ```env
   APP_NAME=WeebYaps
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=weebyaps_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Generate application key**
   ```bash
   php artisan key:generate
   ```

7. **Create database**
   - Create a MySQL database named `weebyaps_db`
   - Update your `.env` file with the correct database credentials

8. **Run database migrations**
   ```bash
   php artisan migrate:fresh
   ```

9. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

10. **Create storage symlink**
    ```bash
    php artisan storage:link
    ```

11. **Compile frontend assets**
    ```bash
    npm run build
    ```

12. **Start the development server**
    ```bash
    php artisan serve
    ```

13. **Access the application**
    - Open your browser and visit `http://localhost:8000`


### Testing Admin Interface

1. Create your admin account in registration page then immediately logout.
2. Change the role of that account to admin in the role column of the users table in the database via database management tool like phpMyAdmin in XAMPP.
3. Login that account again to see the admin dashboard.
