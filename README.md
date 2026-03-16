# Delicious Discoveries

## Overview

The Recipe App is a web application built using Laravel that allows users to create, view, and filter recipes by categories. Authenticated users can comment on recipes, like them, and paginate through the list of recipes while maintaining their filters.

## Features

- Recipe Management: Create, view, and manage recipes.
- Category Filtering: Filter recipes by category.
- Comments: Authenticated users can comment on recipes, except their own.
- Likes: Authenticated users can like/unlike recipes, except their own.
- Pagination: Recipes are paginated with filters preserved across pages.

## Installation

### Prerequisites

Before you begin, ensure you have the following installed on your machine:

- PHP >= 8.2
- Composer
- Node.js and npm
- Laravel
- A database (MySQL, PostgreSQL, etc.)

### Steps

#### 1. Clone the repository

- `git clone https://github.com/Volodymyr0587/delicious-discoveries`

- `cd delicious-discoveries`

#### 2. Install dependencies

- `composer install`
- `npm install`

#### 3. Set up environment variables

- `cp .env.example .env`

- Update the .env file with your database credentials and other necessary configurations.

#### 4. Generate Application Key

- `php artisan key:generate`

#### 5. Link storage

- Create a symbolic link from `public/storage` to `storage/app/public`:

    `php artisan storage:link`

#### 6. Build assets

- Build the frontend assets:

    `npm run dev`

#### 7. Serve the Application

- To run application at http://localhost:8000

    `php artisan serve`

## Database Seeding

This project includes database seeders that populate the application with demo data such as users, categories, and recipes.

### Seeded Data

The following data will be created:

**Users**

Several demo users:

- Chef Ivan
- Chef Olena
- Chef Taras

**Categories**

Recipe categories such as:

- перші страви
- другі страви
- салати та закуски
- випічка
- торти
- десерти
- напої
- сніданки
- соуси та заправки
- гарніри
- паста та макарони
- гриль та барбекю

**Recipes**

Each category contains multiple real recipes including ingredients and descriptions.
Recipes are randomly assigned to available users.

---

### Run migrations and seed the database

```bash
php artisan migrate:fresh --seed
```

This command will:

1. Drop all tables
2. Run all migrations
3. Seed the database with demo data

---

### Seeder Structure

```
database/seeders
├── DatabaseSeeder.php
├── CategorySeeder.php
├── UserSeeder.php
└── RecipeSeeder.php
```

Seeder responsibilities:

- **CategorySeeder** – creates recipe categories
- **UserSeeder** – creates demo users
- **RecipeSeeder** – creates recipes and attaches them to categories and users

### Usage

**Authentication**

Register a new user or log in with existing credentials. Only authenticated users can create, like, or comment on recipes.

**Recipe Management**

**_Create a Recipe:_** Navigate to the "Create Recipe" page, fill out the form, and submit.

**_View Recipes:_** Browse through the list of recipes on the homepage.

**_Filter by Category:_** Use the category dropdown to filter recipes.

**_Pagination:_** Use the pagination links to navigate through pages, retaining the applied filters.

**_Comments:_** Authenticated users can comment on recipes. Users cannot comment on their own recipes. The comment form is displayed at the top of the comments section.

**_Likes:_** Authenticated users can like/unlike recipes. Users cannot like their own recipes. Likes are updated without reloading the page using AlpineJS.

### Additional Notes

The application uses AlpineJS for handling likes without reloading the page. Use the .env file to configure the application settings, such as the database connection and other environment-specific configurations.

## License

Free to use and modify.
