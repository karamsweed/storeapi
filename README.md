# StoreAPI

**StoreAPI** is a RESTful API built with Laravel that provides endpoints for managing products and orders.  
It includes **L5-Swagger** for interactive API documentation.

## Features

- ✅ **Product Management**: R operations for products
- ✅ **Order Processing**: Handle customer orders
- ✅ **Authentication**: Secure endpoints using Laravel auth
- ✅ **L5-Swagger API Documentation** 📖

---

## 🚀 Installation

### **1️⃣ Clone the repository**
```sh
git clone https://github.com/karamsweed/storeapi.git
cd storeapi
```

### **2️⃣ Install Dependencies**
```sh
composer install
npm install
```

### **3️⃣ Set up environment file**
```sh
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with **database credentials**:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### **4️⃣ Run Migrations & Seed Database**
```sh
php artisan migrate --seed
```

---


### **5️⃣ Access API Documentation**
Start the server:
```sh
php artisan serve
```
Then, open Swagger UI in your browser:
```
http://localhost:8000/api/documentation
```

> 📌 **Tip**: If docs are not updating, clear cache:
```sh
php artisan config:clear
php artisan cache:clear
php artisan l5-swagger:generate
```

---

## 📡 API Endpoints

### **🔹 Products**
| Method | Endpoint | Description |
|--------|---------|-------------|
| **GET** | `/api/products` | List all products |
| **GET** | `/api/products/{id}` | Retrieve a product |

### **🔹 Orders**
| Method | Endpoint | Description |
|--------|---------|-------------|
| **POST** | `/api/orders` | Create an order |
---

## 🔑 Authentication

L5-Swagger supports **Laravel Passport** or **Sanctum** for authentication.  
Ensure you pass a **Bearer Token** in API requests after logging in.

---
### **User Login Credentials for Testing**
After running the database seeder, you can use the following test user to log in:

- **Email:** `test@example.com`
- **Password:** `password123`

