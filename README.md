# Laravel Assessment Portal

A Laravel 10 + Vue.js application with two assessment modules:
1. User Management System
2. Category Management System (Parent-Child Hierarchy)

## Features

- User management with details tracking
- Category hierarchy management
- Email notifications for new user creation
- Responsive design with Tailwind CSS
- Vue.js frontend with Vue Router

## Installation

### Prerequisites

- PHP 8.1+
- Composer 2.0+
- Node.js 16+
- MySQL 8.0+
- Laravel 10

### Setup Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-repo/laravel-assessment-vue.git
   cd laravel-assessment-vue

2. **Install PHP dependencies:**:
   ```bash
   composer install
3. **Install JavaScript dependencies**:
   ```bash
   npm install
4. **Create environment file**:
   ```bash
   cp .env.example .env
5. **Generate application key**:
   ```bash
   php artisan key:generate
6. **Configure database**:
    ```bash
   Edit .env file with your database credentials:
   DB_DATABASE=laravel_assessment
   DB_USERNAME=root
   DB_PASSWORD=
7. **Run migrations**:
    ```bash
   php artisan migrate
8. **Build assets**:
   ```bash
   npm run build
9. **Configure mail settings (in .env)**:
   ```bash
   For local development, you can use Mailpit:
    MAIL_MAILER=smtp
    MAIL_HOST=localhost
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
10. **Start the development servers**:
    ```bash
    open the below commands In separate terminals:
    php artisan serve
    npm run dev
**Project Structure**
```bash
laravel-assessment-vue/
├── app/
│   ├── Http/Controllers/
│   │   ├── Assessment1Controller.php
│   │   └── Assessment2Controller.php
│   ├── Mail/
│   │   └── UserCreatedNotification.php
│   └── Models/
│       ├── User.php
│       ├── Detail.php
│       └── Category.php
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   ├── Assessment1/
│   │   │   └── Assessment2/
│   │   ├── router.js
│   │   └── app.js
│   └── views/
│       └── layouts/
│           └── app.blade.php
├── routes/
│   ├── api.php
│   └── web.php
└── database/
    ├── migrations/
    └── seeders/


Key Functionality
**Assessment 1: User Management**
Create/Read/Update/Delete users

Track additional user details through events

Send welcome email on user creation

**Assessment 2: Category Management**
Category system

Parent-child relationships

Full path display (e.g., "Parent > Child > Subchild")
