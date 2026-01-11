<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<!-- ![Employee Table Screenshot](images/employees.png) -->

# Employee Management Backend

This is the **Laravel API backend** for the Employee Management System.  
It provides CRUD operations for employees and authentication using **Laravel Sanctum**.

---

## 🛠 Prerequisites

- PHP 8.1+
- Composer
- MySQL
- Laravel 10+
- XAMPP / Local server for development

---

## ⚡ Setup Instructions

1. **Clone the repository**
```bash
git clone <your-backend-repo-url>
cd backend
```

2. **Install dependencies**
```bash
composer install
```

3. **Copy .env file**

```bash
cp .env.example .env
```

4. **Configure database**

Edit .env:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_management
DB_USERNAME=root
DB_PASSWORD=
```

5. **Generate application key**
```bash
php artisan key:generate
```

6. **Run migrations**
```bash
php artisan migrate
```

7. **Seed sample data**
```bash
php artisan db:seed
```

8. **Start the development server**
```bash
php artisan serve
```

API will run on http://localhost:8000/api.



## 🔐 Authentication Flow
1. **Login**

- Endpoint: POST /api/login

- User enters email and password.

- Backend validates credentials.

- On success, a Sanctum token is returned and used in Authorization headers for future requests.

**Request Example**
```bash
POST /api/login
{
  "email": "test@example.com",
  "password": "password123"
}

```

**Response Example**
```bash
{
  "status": "success",
  "message": "Logged in successfully",
  "token": "1|abcdefg1234567890token",
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@example.com"
  }
}

```

2. **Logout**

- Endpoint: POST /api/logout

- Requires Authorization header with Bearer token.

- Deletes current access token.

**Request Example**


```bash
POST /api/logout
Authorization: Bearer 1|abcdefg1234567890token

```



## 🧾 Available API Endpoints

All endpoints are under http://localhost:8000/api:


| Endpoint         | Method | Description        | Body / Params                               |
| ---------------- | ------ | ------------------ | ------------------------------------------- |
| `/login`         | POST   | Authenticate user  | `{ "email", "password" }`                   |
| `/logout`        | POST   | Logout user        | Header: `Authorization: Bearer <token>`     |
| `/employees`     | GET    | Get all employees  | Header: `Authorization: Bearer <token>`     |
| `/employees`     | POST   | Add new employee   | `{ name, email, position, salary, status }` |
| `/employees/:id` | GET    | Get employee by ID | Header: `Authorization: Bearer <token>`     |
| `/employees/:id` | PUT    | Update employee    | `{ name, email, position, salary, status }` |
| `/employees/:id` | DELETE | Delete employee    | Header: `Authorization: Bearer <token>`     |




## 📝 Request & Response Examples
1. **Get All Employees**
```bash
GET /api/employees
Authorization: Bearer 1|abcdefg1234567890token

```

**Response Example**

```bash
{
  "status": "success",
  "message": "Employees retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "position": "Manager",
      "salary": 5000,
      "status": "active"
    },
    {
      "id": 2,
      "name": "Jane Smith",
      "email": "jane@example.com",
      "position": "Developer",
      "salary": 4000,
      "status": "inactive"
    }
  ]
}

```


2. **Add Employee**


```bash
POST /api/employees
Authorization: Bearer 1|abcdefg1234567890token
{
  "name": "Fadel Mohammad",
  "email": "Fadel@example.com",
  "position": "Designer",
  "salary": 3500,
  "status": "active"
}

```
**Response Example**
```bash
{
  "status": "success",
  "message": "Employee created successfully",
  "data": {
    "id": 3,
    "name": "Fadel Mohammad",
    "email": "Fadel@example.com",
    "position": "Designer",
    "salary": 3500,
    "status": "active"
  }
}

```


3. **Get Employee by ID**
```bash
GET /api/employees/3
Authorization: Bearer 1|abcdefg1234567890token
```

**Response Example**




```bash
{
  "status": "success",
  "message": "Employee retrieved successfully",
  "data": {
    "id": 3,
    "name": "Fadel Mohammad",
    "email": "Fadel@example.com",
    "position": "Designer",
    "salary": 3500,
    "status": "active"
  }
}

```
4. **Update Employee**


```bash
PUT /api/employees/3
Authorization: Bearer 1|abcdefg1234567890token
{
  "position": "Senior Designer",
  "salary": 4000
}
```


**Response Example**
```bash
{
  "status": "success",
  "message": "Employee updated successfully",
  "data": {
    "id": 3,
    "name": "Fadel Mohammad",
    "email": "Fadel@example.com",
    "position": "Senior Designer",
    "salary": 4000,
    "status": "active"
  }
}
```
5. **Delete Employee**
```bash
DELETE /api/employees/3
Authorization: Bearer 1|abcdefg1234567890token
```

**Response Example**

```bash
{
  "status": "success",
  "message": "Employee deleted successfully"
}
```

## 💡 Notes

- Form validation is handled using Form Requests (StoreEmployeeRequest, UpdateEmployeeRequest).

- Email uniqueness is enforced in both store and update requests.

- All /employees routes require authentication token (Sanctum).

- Proper HTTP status codes are returned for success, validation errors, and server errors.

- Use php artisan db:seed to generate sample users and employees.


## 🔧 Quick Commands
```bash
php artisan migrate:fresh --seed   # Reset database and seed
php artisan serve                   # Run Laravel server
```

## 🚀 Test API with Postman


### GET All Employees
![Get Employees Request](/public/images/first%20test%20for%20get%20.png)

### POST New Employee
![Add Employee Request](/public/images/first%20test%20for%20post.png)

### Authentication Check
![Auth Check Request](/public/images/first%20test%20for%20auth%20and%20get%20.png)

### Login
![Login Request](/public/images/first%20test%20for%20auth%20login.png)

### Logout
![Logout Request](/public/images/first%20test%20for%20auth%20and%20logout.png)

### DELETE Employee
![Delete Employee Request](/public/images/first%20test%20for%20%20delet.png)

### PUT Update Employee
![Update Employee Request](/public/images/first%20test%20for%20put.png)

