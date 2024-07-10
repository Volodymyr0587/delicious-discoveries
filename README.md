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

###  Prerequisites

Before you begin, ensure you have the following installed on your machine:

- PHP >= 8.2
- Composer
- Node.js and npm
- Laravel
- A database (MySQL, PostgreSQL, etc.)

### Steps

1. Clone the repository

- `git clone https://github.com/Volodymyr0587/delicious-discoveries`

- `cd recipe-app`

2. Install dependencies

- `composer install`
- `npm install`

3. Set up environment variables

- `cp .env.example .env`

- Update the .env file with your database credentials and other necessary configurations.

4. Generate Application Key

- `php artisan key:generate`

5. Run Migrations and Seeders

- Set up the database by running migrations and seeders:

- `php artisan migrate --seed`

6. Link storage

- Create a symbolic link from `public/storage` to `storage/app/public`:

    `php artisan storage:link`

7. Build assets

- Build the frontend assets:

    `npm run dev`

8. Serve the Application

    `php artisan serve`

    The application should now be running at http://localhost:8000.

### Usage

**Authentication**

Register a new user or log in with existing credentials. Only authenticated users can create, like, or comment on recipes.

**Recipe Management**

***Create a Recipe:***  Navigate to the "Create Recipe" page, fill out the form, and submit.

***View Recipes:*** Browse through the list of recipes on the homepage. 

***Filter by Category:*** Use the category dropdown to filter recipes. 

***Pagination:*** Use the pagination links to navigate through pages, retaining the applied filters.

***Comments:*** Authenticated users can comment on recipes. Users cannot comment on their own recipes. The comment form is displayed at the top of the comments section.

***Likes:*** Authenticated users can like/unlike recipes. Users cannot like their own recipes. Likes are updated without reloading the page using AlpineJS.

### Additional Notes

The application uses AlpineJS for handling likes without reloading the page. Use the .env file to configure the application settings, such as the database connection and other environment-specific configurations.



## License

This project is licensed under the MIT License.
