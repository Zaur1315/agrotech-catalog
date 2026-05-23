# AgroTech Catalog

AgroTech Catalog is a Laravel-based MVP for an agricultural equipment dealer website.

The project was built as a reusable base for commercial catalog websites in agriculture, automotive, motorcycle, powersports, and equipment sales niches. It includes a public catalog, equipment detail pages, quote request workflow, quote list functionality, and an admin panel for managing inventory and leads.

---

## Tech Stack

- PHP 8.2+
- Laravel 12
- PostgreSQL
- Filament Admin Panel
- Blade
- Tailwind CSS
- Vite
- Session-based quote cart

---

## Main Features

### Public Website

- Modern landing page
- Equipment catalog
- Category pages
- Product detail pages
- Product image gallery
- Product specifications
- Catalog filters:
    - Brand
    - Condition
    - Price range
    - Model year
    - Sorting
- Single product quote request form
- Quote list for multiple products
- Contact page
- Responsive layout
- Dark commercial UI with green accent styling

### Admin Panel

The project includes a Filament-based admin panel.

Admin can manage:

- Categories
- Brands
- Products
- Product images
- Product specifications
- Leads / quote requests

### Quote Workflow

The project supports two lead generation flows:

1. Product quote request  
   A customer sends a request directly from a product detail page.

2. Quote list request  
   A customer adds multiple products to the quote list and sends one combined request.

All requests are stored as leads and can be reviewed in the admin panel.

---

## Project Goal

The goal of this project is not only to build a single MVP website, but also to create a reusable Laravel base for fast production of similar commercial equipment catalog websites.

The structure can be reused for:

- Agricultural equipment dealers
- Motorcycle dealers
- Powersports stores
- Automotive catalogs
- Heavy machinery catalogs
- Parts and equipment request platforms

---

## Installation

Clone the repository:

```bash
git clone <repository-url>
cd agrotech-catalog
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## Database Setup

The project is configured for PostgreSQL by default.

Create database and user:

```sql
CREATE USER agrotech_user WITH PASSWORD 'agrotech_password';
CREATE DATABASE agrotech_catalog OWNER agrotech_user;
GRANT ALL PRIVILEGES ON DATABASE agrotech_catalog TO agrotech_user;
```

Update `.env` if needed:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=agrotech_catalog
DB_USERNAME=agrotech_user
DB_PASSWORD=agrotech_password
```

Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

Create storage symlink:

```bash
php artisan storage:link
```

---

## Running the Project

Start Laravel development server:

```bash
php artisan serve
```

Start Vite development server:

```bash
npm run dev
```

Open the website:

```text
http://127.0.0.1:8000
```

---

## Admin Panel

Admin panel URL:

```text
http://127.0.0.1:8000/admin
```

Default admin credentials:

```text
Email: admin@example.com
Password: password
```

The default admin user is created by `DatabaseSeeder`.

---

## Demo Data

Seeders create demo data for:

- Categories
- Brands
- Products
- Product specifications
- Product images
- Admin user

Demo equipment includes tractors, harvesters, utility vehicles, balers, and attachments.

---

## Public Routes

```text
GET     /                    Home page
GET     /catalog             Equipment catalog
GET     /catalog/{slug}      Category page
GET     /equipment/{slug}    Product detail page
POST    /equipment/{slug}/quote
GET     /quote               Quote list page
POST    /quote/{slug}/add
DELETE  /quote/{slug}/remove
POST    /quote/submit
GET     /contact
POST    /contact
```

---

## Admin Resources

```text
Catalog
- Categories
- Brands
- Products

Sales
- Leads
```

---

## Useful Commands

Clear cache:

```bash
php artisan optimize:clear
```

Rebuild database with seed data:

```bash
php artisan migrate:fresh --seed
```

Build frontend assets:

```bash
npm run build
```

Run Laravel Pint:

```bash
./vendor/bin/pint
```

Check routes:

```bash
php artisan route:list
```

---

## Notes

- Product images uploaded from the admin panel are stored on the public disk.
- Demo images can be served from the public directory or public storage disk.
- Quote list is session-based and does not require user registration.
- Leads are stored in the database and managed from the admin panel.
- The public Admin button is visible only for authenticated users.

---

## Final Manual Checklist

Before submitting or deploying the project, check the following scenarios:

- Home page opens correctly.
- Catalog page opens correctly.
- Category pages open correctly.
- Catalog filters work.
- Product detail page opens correctly.
- Product images are displayed correctly.
- Product quote form creates a lead.
- Add to quote list works.
- Quote list counter works.
- Quote list submit creates a lead with selected products.
- Contact form creates a lead.
- Admin login works.
- Admin button is hidden for guests.
- Products are visible in admin.
- Product images are visible in admin table.
- Image upload from admin works.
- Leads are visible in admin.
- Mobile layout is acceptable.

---

## Future Improvements

Possible next steps:

- Product availability status
- Dealer location management
- Email notifications for new leads
- Lead status history
- Advanced inventory search
- Saved filters
- Multi-language support
- SEO meta management
- Deployment configuration
- Automated tests

---

### [Scroll to Top ↑](#agroTech-catalog)
