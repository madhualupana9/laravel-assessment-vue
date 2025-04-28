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
   git clone https://github.com/madhualupana/laravel-assessment-vue.git
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
## Screenshots

### Dashboard Overview
![Image](https://github.com/user-attachments/assets/eb6af810-5f96-4b3e-8297-e45e96ee071e)

### Assessment 1: User Management
#### User Listing Page
![Image](https://github.com/user-attachments/assets/986bccac-c6c9-40dd-ae12-3c5e93e54647)

#### Create New User Form
![Image](https://github.com/user-attachments/assets/e3fdd630-54bb-4408-8169-ae112f2e0bbd)

#### User Details View
![Image](https://github.com/user-attachments/assets/47a4a832-fa06-4f1d-a9d9-b939e5def263)

---

### Assessment 2: Category Management

#### Category Listing page
![Image](https://github.com/user-attachments/assets/b73ff747-6129-4c44-9b1c-acb7f412995d)

#### Category Edit Form
![image](https://github.com/user-attachments/assets/535d9c5d-af0e-4333-9830-70ad324778c9)

#### Mobile Responsive View
![image](https://github.com/user-attachments/assets/ce95d5d0-75b9-4d5c-b5e3-133b6813c36a)

### Email Notification Example
![image](https://github.com/user-attachments/assets/8a920d4a-bfc9-4e97-8e0c-76741b571781)


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


