# CLAUDE.md — 1640Group1 Project Guide

## Project Overview

Laravel 12 idea management system (PHP 8.2, PostgreSQL, Blade + Tailwind CSS v4, Vite).

**Roles:** Admin and Staff with separate dashboards and permissions.

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 12, PHP 8.2 |
| Frontend | Blade templates, Tailwind CSS v4 |
| Build | Vite 7 |
| Database | PostgreSQL (pgsql) |
| Auth | Custom (no Laravel Breeze/Jetstream) |

---

## Initial Setup (First Time)

### Prerequisites

- PHP 8.2+
- Composer
- Node.js + npm
- PostgreSQL 18.x + pgAdmin 4

### Step 1 — Install dependencies

```bash
composer install
npm install
```

### Step 2 — Generate app key

```bash
php artisan key:generate
```

### Step 3 — Create .env

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

Then open `.env` and replace the database block with:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=1640Group1
DB_USERNAME=postgres
DB_PASSWORD=123456

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
CACHE_STORE=file
```

### Step 4 — Set up local PostgreSQL database

1. Open **pgAdmin 4**
2. Right-click **Servers** → **Register** → **Server**
   - Name: `1640Group1Server`
   - Connection tab:
     - Host: `localhost`
     - Username: `postgres`
     - Password: `123456`
     - Check "Save password"
3. In the new server, right-click **Databases** → **Create** → **Database**
   - Name: `1640Group1`

### Step 5 — Run migrations and seed data

```bash
php artisan migrate:fresh --seed
```

This creates all tables and inserts test users + categories.

**Test accounts after seeding:**

| Role | Username | Email | Password |
|------|----------|-------|----------|
| Admin | `admin_test` | `admin@test.com` | `123456` |
| Staff | `staff_test` | `staff@test.com` | `123456` |
| Staff | `staff2` | `staff2@gmail.com` | `123456` |

### Step 6 — Create storage symlink (first time only)

```bash
php artisan storage:link
```

Required for file uploads (Word/PDF) to be accessible publicly.

---

## Running the Dev Server

**Option A — All-in-one (recommended):**

```bash
composer run dev
```

Runs concurrently: Laravel server + queue listener + Pail logs + Vite.

**Option B — Separate terminals:**

```bash
# Terminal 1 — Laravel
php artisan serve

# Terminal 2 — Vite (frontend assets)
npm run dev
```

App runs at: http://127.0.0.1:8000

---

## Database

### Re-seed (reset all data)

```bash
php artisan migrate:fresh --seed
```

### Run new migrations only

```bash
php artisan migrate
```

### Check migration status

```bash
php artisan migrate:status
```

---

## Key Directories

```
app/Http/Controllers/   — AdminController, StaffController, PortalController
app/Models/             — User, Idea, Category, Reaction, Department
database/migrations/    — Schema definitions
database/seeders/       — UserSeeder, CategorySeeder, DatabaseSeeder
resources/views/
  admin/                — Admin dashboard Blade views
  staff/                — Staff dashboard Blade views
  portal/               — Login, forgot password, reset password
  layouts/app.blade.php — Main layout
routes/web.php          — All routes
storage/app/public/     — Uploaded files (ideas' Word/PDF)
```

---

## Routes Summary

| Prefix | Middleware | Description |
|--------|-----------|-------------|
| `/` | guest | Login, forgot/reset password |
| `/admin/*` | auth + Admin role | Admin dashboard, user management, ideas |
| `/staff/*` | auth + Staff role | Staff home, submit ideas, social feed |
| `/change-password` | auth | Change password (verify step) |
| `/change-password/new` | auth | Change password (set new password step) |

### Change Password Flow (logged-in users)

1. `GET /change-password` → form: current password + security question + answer
2. `POST /change-password` → verify; on success → redirect to step 3
3. `GET /change-password/new` → form: new password + confirm (session-gated)
4. `POST /change-password/update` → save new password → redirect to home with success flash

### Forgot Password Flow (guest)

1. `GET /forgotPassword` → form: email + security question + answer
2. `POST /forgotPassword` → verify; on success → redirect to step 3
3. `GET /newPassword` → form: new password + confirm (session-gated)
4. `POST /resetPassword` → save new password → redirect to login

---

## Database Schema

Tables: `users`, `categories`, `ideas`, `reactions`, `department`

- `users.userId` — primary key (not `id`)
- `users.passwordHash` — hashed password (not `password`)
- `users.role` — `Admin` or `Staff`
- `ideas.filePath` — path to uploaded Word/PDF file
- `reactions` — unique (ideaId, userId): one vote per user per idea

---

## Common Commands

```bash
# Tinker (interactive REPL)
php artisan tinker

# Clear all caches
php artisan optimize:clear

# View routes
php artisan route:list

# Run tests
php artisan test
```

---

## Notes

- **No Docker** — manual PostgreSQL installation required
- **Vietnamese codebase** — comments and variable names may be in Vietnamese
- `Department` model exists but migration is incomplete (no columns defined yet)
- Password recovery uses security questions (favorite animal, favorite color, child birth year)
- File uploads stored in `storage/app/public/` — requires `storage:link` to be accessible
- **Change Password** button appears above Logout in both admin (`admin/home.blade.php`) and staff (`layouts/app.blade.php` sidebar)
- All password forms use Bootstrap alert-danger for error display, consistent with login page style
- `portal/changePassword.blade.php` and `portal/changePasswordNew.blade.php` are the two-step change-password views
