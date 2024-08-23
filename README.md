<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Jaypur - E-commerce Website

Jaypur is an e-commerce website developed as a learning project using the Laravel framework. The project focuses on implementing core functionalities of an e-commerce platform, including user authentication, product management, and SQL database integration. 

This project was created for the sole purpose of learning and experimenting with Laravel, showcasing the capabilities of the framework in building a basic but functional e-commerce website.

## Features

### 1. SQL Database
- **Database Design:** The website uses a relational SQL database to manage the backend data.
- **Tables:** The database includes tables for `users`, `products`, and `images`.
- **Relationships:** Users are associated with multiple products, and each product can have multiple images.

### 2. User Management
- **Authentication:** User authentication is managed using Laravel Breeze.
- **Registration & Login:** Users can create an account and log in to access the platform.
- **Profile Management:** Once logged in, users can view and manage their profiles.

### 3. Product Management
- **CRUD Operations:** Administrators can perform Create, Read, Update, and Delete operations on products.
- **Image Upload:** Products can be associated with multiple images, allowing for a detailed presentation.

## Purpose of the Project
This project was developed independently with the primary goal of learning the Laravel framework. It serves as a practical application of the concepts learned and is not intended for production use. The development of Jaypur was driven by a desire to understand how Laravel can be used to build robust and scalable web applications.

## Technologies Used
- **Laravel Framework:** The core framework used for backend development.
- **Laravel Breeze:** For user authentication and basic user management.
- **SQL Database:** For storing and managing data related to users, products, and images.
- **HTML/CSS:** For building the front-end user interface.

## Getting Started
To explore this project, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/SoloQueueTrash/jaypur.git
   ```
2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```
3. **Set up the environment:**
   - Copy the `.env.example` file to `.env` and configure your database settings.
   - Run the migrations:
     ```bash
     php artisan migrate
     ```
4. **Run the application:**
   ```bash
   php artisan serve
   ```
   Open your browser and navigate to `http://localhost:8000` to see the website in action.

## Contributing
This project was created as a learning exercise, and contributions are not being accepted at this time. However, you are welcome to fork the repository and make your own modifications.

