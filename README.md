# MoneHive - Aplikasi Manajemen Keuangan Personal

## 📋 Deskripsi Proyek
MoneHive adalah aplikasi web Progressive Web App (PWA) untuk manajemen keuangan personal yang dibangun menggunakan Laravel 12 dan Laravel Breeze. Aplikasi ini memungkinkan pengguna untuk melacak transaksi keuangan, mengelola dompet, mengatur budget, dan mengkategorikan pengeluaran/pemasukan.

---

## ✅ Fitur yang Telah Diimplementasikan

### 1. 🎨 **Frontend**
- **Framework**: Laravel Blade Templates dengan Tailwind CSS
- **UI Components**: Menggunakan Alpine.js untuk interaktivitas
- **Responsive Design**: Mendukung tampilan desktop, tablet, dan mobile
- **Build Tool**: Vite untuk bundling assets (CSS & JavaScript)

**Halaman Frontend yang Tersedia:**
- Landing Page (`/`)
- Dashboard (`/dashboard`)
- Halaman Transaksi (`/transactions`)
- Halaman Dompet (`/wallets`)
- Halaman Budget (`/budgets`)
- Halaman Profile (`/profile`)
- Halaman Authentication (Login, Register, Forgot Password)

**Lokasi File Frontend:**
```
resources/
├── css/
│   └── app.css          # Tailwind CSS styling
├── js/
│   ├── app.js           # JavaScript utama
│   └── bootstrap.js     # Bootstrap dependencies
└── views/               # Blade templates
    ├── welcome.blade.php
    ├── dashboard.blade.php
    ├── profile.blade.php
    └── ...
```

---

### 2. ⚙️ **Backend**
- **Framework**: Laravel 12 (PHP 8.2+)
- **Architecture**: MVC (Model-View-Controller)
- **ORM**: Eloquent ORM untuk database operations

**Controllers yang Tersedia:**
```php
app/Http/Controllers/
├── Auth/                           # Authentication controllers (Laravel Breeze)
├── DashboardController.php         # Dashboard logic
├── TransactionController.php       # Manajemen transaksi
├── WalletController.php            # Manajemen dompet
├── BudgetController.php            # Manajemen budget
├── CategoryController.php          # Manajemen kategori
└── ProfileController.php           # Manajemen profil user
```

**Models yang Tersedia:**
```php
app/Models/
├── User.php                        # Model user
├── Wallet.php                      # Model dompet
├── Transaction.php                 # Model transaksi
├── Budget.php                      # Model budget
└── Category.php                    # Model kategori
```

---

### 3. 🌐 **Web Service / API Routes**
Laravel menyediakan routing yang dapat digunakan untuk API:

**Routes yang Tersedia:**
```php
// Public Routes
GET  /                              # Landing page

// Protected Routes (require authentication)
GET  /dashboard                     # Dashboard utama
GET  /transactions                  # List transaksi
GET  /transactions/create           # Form tambah transaksi
POST /transactions                  # Store transaksi baru

GET  /wallets                       # List dompet
POST /wallets                       # Store dompet baru

GET  /budgets                       # List budget
POST /categories                    # Store kategori baru

GET  /profile/edit                  # Edit profile
PATCH /profile                      # Update profile
DELETE /profile                     # Delete account
```

**Untuk mengaktifkan API REST:**
Uncomment di `bootstrap/app.php`:
```php
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',  // Aktifkan ini
    commands: __DIR__.'/../routes/console.php',
)
```

---

### 4. 🗄️ **Database**
- **Database Engine**: Support MySQL, PostgreSQL, SQLite
- **Migration System**: Laravel Migrations untuk version control database
- **Seeding**: Database seeders untuk data dummy

**Database Schema:**

**Tabel Users:**
```sql
- id (primary key)
- name
- email (unique)
- password (hashed)
- remember_token
- created_at, updated_at
```

**Tabel Wallets:**
```sql
- id (primary key)
- user_id (foreign key -> users)
- name (nama dompet)
- balance (saldo)
- created_at, updated_at
```

**Tabel Categories:**
```sql
- id (primary key)
- user_id (foreign key -> users)
- name (nama kategori)
- type (income/expense)
- created_at, updated_at
```

**Tabel Transactions:**
```sql
- id (primary key)
- user_id (foreign key -> users)
- wallet_id (foreign key -> wallets)
- category_id (foreign key -> categories)
- amount (jumlah)
- type (income/expense)
- description
- transaction_date
- created_at, updated_at
```

**Tabel Budgets:**
```sql
- id (primary key)
- user_id (foreign key -> users)
- category_id (foreign key -> categories)
- amount (limit budget)
- period (monthly/yearly)
- created_at, updated_at
```

**Migrations yang Tersedia:**
```
database/migrations/
├── 0001_01_01_000000_create_users_table.php
├── 0001_01_01_000001_create_cache_table.php
├── 0001_01_01_000002_create_jobs_table.php
├── 2025_12_14_000100_create_wallets_table.php
├── 2025_12_14_000110_create_categories_table.php
├── 2025_12_14_000120_create_transactions_table.php
├── 2025_12_14_000130_create_budgets_table.php
├── 2025_12_14_010000_alter_categories_add_user_id.php
└── 2025_12_14_010010_alter_transactions_rename_date.php
```

---

### 5. 🔐 **Autentikasi**
- **Package**: Laravel Breeze (Blade + Alpine.js)
- **Features**:
  - ✅ User Registration
  - ✅ User Login
  - ✅ Password Reset
  - ✅ Email Verification
  - ✅ Password Confirmation
  - ✅ Profile Management
  - ✅ Session Management
  - ✅ CSRF Protection

**Authentication Routes:**
```php
POST   /register                    # Register user baru
POST   /login                       # Login user
POST   /logout                      # Logout user
POST   /forgot-password             # Request password reset
POST   /reset-password              # Reset password
GET    /verify-email                # Email verification
POST   /email/verification-notification
```

**Middleware Protection:**
```php
Route::middleware(['auth'])->group(function () {
    // Protected routes here
});
```

---

### 6. 📱 **Progressive Web App (PWA)**

**Manifest File** (`public/manifest.json`):
```json
{
  "name": "MoneHive",
  "short_name": "MoneHive",
  "start_url": "/dashboard",
  "display": "standalone",
  "theme_color": "#4f46e5",
  "background_color": "#ffffff",
  "orientation": "portrait-primary",
  "icons": [
    {
      "src": "/icons/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png"
    }
  ]
}
```

**Service Worker** (`public/service-worker.js`):
- ✅ Install event handler
- ✅ Fetch event handler untuk offline support
- ✅ Cache strategy untuk assets

**PWA Features:**
- ✅ Installable di home screen (Android & iOS)
- ✅ Offline support (basic)
- ✅ Standalone display mode
- ✅ Custom theme color
- ✅ App icons (192x192 & 512x512)

**Cara Mengaktifkan PWA:**
1. Buka aplikasi di browser mobile
2. Klik menu "Add to Home Screen"
3. Aplikasi akan terinstall seperti native app

---

### 7. ☁️ **Deployment ke VPS/Cloud (Nilai Plus)**

Proyek ini sudah dilengkapi dengan konfigurasi deployment:

#### **A. Deployment ke Railway/Heroku**
File `Procfile` sudah tersedia:
```
web: vendor/bin/heroku-php-apache2 public/
```

#### **B. Deployment ke Nixpacks (Railway)**
File `nixpacks.toml` sudah tersedia:
```toml
[phases.setup]
nixPkgs = ['...', 'php82', 'php82Packages.composer', 'nodejs_20']

[phases.install]
cmds = ['composer install --no-dev --optimize-autoloader', 'npm ci']

[phases.build]
cmds = ['npm run build', 'php artisan config:cache', 'php artisan route:cache']

[start]
cmd = 'php artisan serve --host=0.0.0.0 --port=${PORT:-8080}'
```

#### **C. Deployment ke VPS Manual**

**Requirements:**
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Nginx/Apache

**Langkah Deployment:**

1. **Clone Repository:**
```bash
git clone https://github.com/yazidzky/monehive.git
cd monehive
```

2. **Install Dependencies:**
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

3. **Setup Environment:**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure Database di `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=monehive
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. **Run Migrations:**
```bash
php artisan migrate --force
```

6. **Set Permissions:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

7. **Configure Nginx:**
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/monehive/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

8. **Setup SSL (Optional but Recommended):**
```bash
sudo certbot --nginx -d your-domain.com
```

9. **Setup Queue Worker (Optional):**
```bash
php artisan queue:work --daemon
```

#### **D. Platform Deployment yang Direkomendasikan:**

1. **Railway** (Recommended - Free Tier Available)
   - Auto-deploy dari GitHub
   - Support PHP & Node.js
   - Database PostgreSQL included
   - Domain gratis

2. **Heroku** (Free Tier Discontinued)
   - Easy deployment
   - Add-ons untuk database

3. **DigitalOcean App Platform**
   - $5/month
   - Managed deployment
   - Auto-scaling

4. **AWS Elastic Beanstalk**
   - Scalable
   - Pay as you go

5. **VPS Manual** (Contabo, Vultr, Linode)
   - Full control
   - $3-5/month
   - Requires manual setup

---

## 🚀 Cara Menjalankan Aplikasi Lokal

### Prerequisites
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite

### Setup Steps

1. **Clone repository:**
```bash
git clone https://github.com/yazidzky/monehive.git
cd monehive
```

2. **Install dependencies:**
```bash
composer install
npm install
```

3. **Setup environment:**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database di `.env`:**
```env
DB_CONNECTION=sqlite
# atau gunakan MySQL/PostgreSQL
```

5. **Create database (jika SQLite):**
```bash
touch database/database.sqlite
```

6. **Run migrations:**
```bash
php artisan migrate
```

7. **Build assets:**
```bash
npm run build
```

8. **Run development server:**
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server (untuk hot reload)
npm run dev
```

9. **Akses aplikasi:**
```
http://localhost:8000
```

### Quick Setup (All-in-one)
```bash
composer run setup
composer run dev
```

---

## 📦 Tech Stack

### Backend
- **Framework**: Laravel 12
- **Language**: PHP 8.2+
- **Authentication**: Laravel Breeze
- **Database ORM**: Eloquent
- **Testing**: PHPUnit

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: Tailwind CSS
- **JavaScript**: Alpine.js
- **Build Tool**: Vite

### Database
- MySQL / PostgreSQL / SQLite

### DevOps
- **Version Control**: Git
- **Dependency Management**: Composer, NPM
- **Deployment**: Railway, Heroku, VPS

---

## 📊 Struktur Database

```
┌─────────────┐
│    Users    │
└──────┬──────┘
       │
       ├──────────┐
       │          │
       ▼          ▼
┌─────────┐  ┌──────────┐
│ Wallets │  │Categories│
└────┬────┘  └─────┬────┘
     │             │
     └──────┬──────┘
            ▼
     ┌──────────────┐
     │ Transactions │
     └──────────────┘
            │
            ▼
     ┌──────────────┐
     │   Budgets    │
     └──────────────┘
```

---

## 🔒 Security Features

- ✅ CSRF Protection
- ✅ XSS Protection
- ✅ SQL Injection Protection (Eloquent ORM)
- ✅ Password Hashing (bcrypt)
- ✅ Session Management
- ✅ Rate Limiting
- ✅ Email Verification
- ✅ Password Reset

---

## 📝 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=TransactionTest

# Run with coverage
php artisan test --coverage
---

## 🎯 Checklist Fitur (Untuk Penilaian)

- ✅ **Frontend**: Laravel Blade + Tailwind CSS + Alpine.js
- ✅ **Backend**: Laravel 12 dengan MVC Architecture
- ✅ **Web Service**: RESTful routes tersedia
- ✅ **Database**: MySQL/PostgreSQL/SQLite dengan Migrations
- ✅ **Autentikasi**: Laravel Breeze (Register, Login, Password Reset)
- ✅ **PWA**: Manifest.json + Service Worker
- ✅ **Upload ke VPS/Cloud**: Konfigurasi deployment tersedia (Railway, Heroku, VPS)

---
