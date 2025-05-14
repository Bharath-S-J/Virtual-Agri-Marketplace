# Virtual Agri-Marketplace

A web-based platform that bridges the gap between farmers and buyers, enabling direct agricultural product trading while eliminating intermediaries.

## 🌟 Project Overview

### 🎯 Purpose
- Empower farmers by providing a direct digital marketplace.
- Offer buyers fresh, farm-to-table products at fair prices.
- Streamline the agricultural supply chain for efficiency and transparency.

### 👥 User Types
1. **Farmers**
   - Manage their profiles and product listings.
   - Track orders, inventory, and sales history.

2. **Buyers**
   - Browse products, manage their cart, and place orders.
   - Access purchase history and receive order updates.

---

## 🚀 Features

### 🔒 Authentication
- Secure registration and login.
- Role-based access control (Farmer/Buyer).
- Password encryption for user safety.

### 🌾 Farmer Features
- **Product Management**:
  - Add, edit, and remove products.
  - Set prices, quantities, and upload images.
- **Inventory Management**:
  - Real-time stock updates after orders.
  - Low-stock alerts for proactive management.
- **Sales Tracking**:
  - View sales history and analyze performance.

### 🛒 Buyer Features
- **Product Browsing**:
  - Filter by categories like Fruits, Vegetables, and Dry Fruits.
  - View detailed product descriptions.
- **Shopping Cart**:
  - Add/remove products and update quantities.
  - Review cart summary before checkout.
- **Order Processing**:
  - Place orders with validated stock.
  - Access detailed purchase history.

### 📦 Inventory & Order Management
- Automated stock validation and updates.
- Secure and efficient order tracking.
- Stock verification before order confirmation.

---

## 🛠️ Technology Stack

### **Frontend**
- **Languages**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5.1.3

### **Backend**
- **Language**: PHP
- **Session Management**: PHP Sessions

### **Database**
- **MySQL** for secure and efficient data storage.

---

## 🔑 Security Highlights
- Password hashing to protect user credentials.
- Session management for secure authentication.
- Input validation and SQL injection prevention.

---

## 📂 Project Structure

```
virtual_agro/
├── index.php              # Main entry point
├── code.php               # Core business logic
├── dbcon.php              # Database connection
├── css/                   # Stylesheets
│   ├── homepage.css
│   ├── farmer.css
│   └── profile.css
├── images/                # Static images
├── product_images/        # Product uploads
├── pro_img/               # Profile images
├── farmer_files/          # Farmer interfaces
└── buyer_files/           # Buyer interfaces
```

---

## ⚙️ Setup Instructions

1. **Database Setup**
   - Create a MySQL database and import the provided structure.
   - Configure database credentials in `dbcon.php`.

2. **Project Setup**
   - Clone this repository.
   - Set up a local web server (Apache/Nginx).
   - Ensure required file permissions for uploads and logs.

3. **Configuration**
   - Define upload directories for product and profile images.
   - Enable error logging for debugging.


