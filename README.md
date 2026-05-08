# JobYaari Blogs — Complete Blog Management System

A full-featured blog management system built with **Laravel 12**, **MySQL**, **Bootstrap 5**, and **jQuery AJAX**. Supports three categories: **Admit Card**, **Result**, and **News** — with a glassmorphism public frontend and a clean admin dashboard.

---

## ✨ Features

- 🔐 Secure admin authentication (custom guard, separate `admins` table)
- 📝 Full CRUD for blog posts (Create, Read, Update, Delete)
- 🖼️ Image upload with validation (JPG, PNG, WebP — max 2MB)
- 🔍 Live AJAX search (debounced — no page reload)
- 🏷️ Category filter buttons (Admit Card, Result, News — no page reload)
- 🔗 Auto-generated URL slugs from blog title
- 📱 Fully responsive (mobile 320px → desktop)
- 🎨 Glassmorphism UI (dark navy + amber palette)
- 📊 Admin dashboard with stat cards and blog table
- 🌱 9 sample blogs pre-seeded for immediate testing

---

## 🚀 Setup Instructions

### Prerequisites
- PHP 8.2+
- Composer
- MySQL (XAMPP / WAMP / Laragon)
- Node.js + npm

### Step 1 — Clone / Navigate to Project
```bash
cd d:/XAMPP/htdocs/v1
```

### Step 2 — Install PHP Dependencies
```bash
composer install
```

### Step 3 — Configure Environment
The `.env` file is already configured for this project:
```
DB_DATABASE=v1
DB_USERNAME=root
DB_PASSWORD=
```
If your MySQL setup differs, edit `.env` accordingly.

### Step 4 — Run Migrations
```bash
php artisan migrate
```
This creates: `users`, `cache`, `jobs`, `sessions`, `students`, `blogs`, `admins` tables.

### Step 5 — Seed Sample Data
```bash
php artisan db:seed
```
This seeds:
- **9 sample blogs** (3 per category)
- **1 default admin account**

### Step 6 — Create Storage Symlink
```bash
php artisan storage:link
```
This links `storage/app/public` → `public/storage` so uploaded images are accessible.

### Step 7 — Start Development Server
```bash
php artisan serve
```
Visit: **http://localhost:8000**

---

## 🔑 Admin Credentials

| Field    | Value                   |
|----------|-------------------------|
| Email    | `admin@jobyaari.com`    |
| Password | `Admin@1234`            |
| URL      | `/admin/login`          |

---

## 🗂️ Folder Structure

```
v1/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── BlogController.php        ← Public blog routes (index, show, search, filter)
│   │   │   ├── AdminController.php       ← Admin CRUD + auth (login, logout, dashboard)
│   │   │   ├── HomeController.php        ← Existing home page
│   │   │   └── StudentController.php     ← Existing students module
│   │   └── Middleware/
│   │       └── AdminAuth.php             ← Custom auth guard middleware
│   └── Models/
│       ├── Blog.php                      ← Blog model (accessors, scopes)
│       └── Admin.php                     ← Admin model (Authenticatable)
│
├── database/
│   ├── migrations/
│   │   ├── 2026_05_07_000001_create_blogs_table.php
│   │   └── 2026_05_07_000002_create_admins_table.php
│   └── seeders/
│       ├── BlogSeeder.php                ← 9 sample blog posts
│       ├── AdminSeeder.php               ← Default admin account
│       └── DatabaseSeeder.php            ← Calls all seeders
│
├── resources/views/
│   ├── layouts/
│   │   ├── blog.blade.php               ← Public blog layout (navbar, footer)
│   │   ├── admin-layout.blade.php       ← Admin panel layout (sidebar, header)
│   │   └── app.blade.php                ← Existing layout (untouched)
│   ├── blogs/
│   │   ├── index.blade.php              ← Blog listing with search + filter
│   │   └── show.blade.php               ← Blog detail page
│   └── admin/
│       ├── login.blade.php              ← Admin login page
│       ├── dashboard.blade.php          ← Blog management table
│       ├── create.blade.php             ← Add new blog form
│       └── edit.blade.php               ← Edit existing blog form
│
├── public/
│   ├── css/
│   │   └── blog.css                     ← Glassmorphism styles for public blog
│   └── js/
│       └── blog-ajax.js                 ← jQuery: live search + category filter AJAX
│
├── routes/
│   └── web.php                          ← All routes (public blog + admin)
│
├── config/
│   └── auth.php                         ← Custom 'admin' guard + 'admins' provider
│
└── bootstrap/
    └── app.php                          ← AdminAuth middleware alias registered
```

---

## 🌐 URL Reference

### Public Routes
| Method | URL                    | Description               |
|--------|------------------------|---------------------------|
| GET    | `/blogs`               | Blog listing page          |
| GET    | `/blogs/{slug}`        | Blog detail page           |
| GET    | `/blogs/search?q=`     | AJAX search endpoint (JSON)|
| GET    | `/blogs/filter?category=` | AJAX filter endpoint (JSON)|

### Admin Routes (login required)
| Method | URL                         | Description              |
|--------|-----------------------------|--------------------------|
| GET    | `/admin/login`              | Login form               |
| POST   | `/admin/login`              | Process login            |
| POST   | `/admin/logout`             | Logout                   |
| GET    | `/admin/dashboard`          | Blog management table    |
| GET    | `/admin/blogs/create`       | Add new blog form        |
| POST   | `/admin/blogs`              | Save new blog            |
| GET    | `/admin/blogs/{id}/edit`    | Edit blog form           |
| PUT    | `/admin/blogs/{id}`         | Update blog              |
| DELETE | `/admin/blogs/{id}`         | Delete blog              |

---

## 🖼️ Image Upload Notes

- Images are stored in `storage/app/public/blogs/`
- Accessible publicly via `public/storage/blogs/` after running `storage:link`
- Accepted formats: JPG, JPEG, PNG, WebP
- Maximum size: **2MB**
- Old images are automatically deleted when a blog is updated or deleted

---

## ⚙️ Database Configuration

Current `.env` settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=v1
DB_USERNAME=root
DB_PASSWORD=
```

**New tables added:**
- `blogs` — stores all blog posts
- `admins` — stores admin user accounts

---

## 🔍 AJAX Filtering

The live search and category filter work together:
1. **Search bar** → fires after 400ms debounce → calls `/blogs/search?q=keyword&category=Current`
2. **Filter buttons** → instant click → calls `/blogs/filter?category=Result&q=currentSearch`
3. Both pass combined state so search-within-category works seamlessly
4. Loading spinner overlay shown during every AJAX request
5. "No results" message shown when 0 blogs match

---

## 🛡️ Security

- CSRF tokens on all POST/PUT/DELETE forms (`@csrf`)
- Admin sessions use a separate guard (`auth.admin`) — isolated from the web guard
- All DB queries use Eloquent (no raw SQL — SQL injection safe)
- Image upload validated (mime type + size) before storage
- Session regenerated on login/logout to prevent session fixation

---

## 🧪 Quick Test Checklist

After setup, verify:
- [ ] `http://localhost:8000/blogs` — shows 9 blog cards
- [ ] Type in search bar — results update without reload
- [ ] Click "Result" filter — only Result blogs shown
- [ ] Click a blog card — detail page opens
- [ ] `http://localhost:8000/admin/login` — login with credentials above
- [ ] Add a new blog with image — appears on listing page
- [ ] Edit a blog — changes saved correctly
- [ ] Delete a blog — removed from table and storage
