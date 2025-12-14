# Panduan Deployment: Vercel & Railway

Panduan ini akan menjelaskan dua skenario deployment yang paling umum untuk Laravel:
1.  **Vercel (App) + Railway (Database)**: Terbaik untuk performa tinggi dan biaya rendah (Free Tier friendly).
2.  **Railway (Full Stack)**: Aplikasi dan Database semuanya di Railway (lebih mudah dikelola tapi mungkin berbayar).

---

## Persiapan Awal (Wajib dilakukan)

Pastikan file berikut sudah ada di project Anda (sudah saya buatkan):
1.  `vercel.json` (Konfigurasi Vercel)
2.  `api/index.php` (Entry point Vercel)
3.  `Procfile` (Konfigurasi Railway)
4.  Updates di `AppServiceProvider.php` (Force HTTPS)

**Lakukan Commit & Push ke GitHub:**
```bash
git add .
git commit -m "Persiapan deployment: config Vercel dan Railway"
git push origin main
```

---

## Opsi 1: Vercel (App) + Railway (Database) (REKOMENDASI)
Setup ini menggunakan Vercel untuk hosting aplikasi Laravel (cepat & gratis) dan Railway hanya untuk Database MySQL/PostgreSQL.

### Langkah 1: Setup Database di Railway
1.  Buka [Railway.app](https://railway.app/) dan login.
2.  Klik **"New Project"** -> **"Provision MySQL"** (atau PostgreSQL).
3.  Tunggu hingga database dibuat.
4.  Klik tab **"Variables"** atau **"Connect"** pada database tersebut.
5.  Catat informasi berikut:
    *   `MYSQLHOST` (atau `PGHOST`)
    *   `MYSQLPORT` (atau `PGPORT`)
    *   `MYSQLUSER` (atau `PGUSER`)
    *   `MYSQLPASSWORD` (atau `PGPASSWORD`)
    *   `MYSQLDATABASE` (atau `PGDATABASE`)

### Langkah 2: Deploy App di Vercel
1.  Buka [Vercel](https://vercel.com/) dan login.
2.  Klik **"Add New..."** -> **"Project"**.
3.  Import repository GitHub `monehive` Anda.
4.  **PENTING**: Di bagian **Environment Variables**, masukkan data dari Railway tadi:
    *   `APP_KEY`: (Copy dari `.env` lokal Anda)
    *   `APP_URL`: `https://nama-project-anda.vercel.app` (isi nanti setelah dapat domain, atau biarkan kosong dulu)
    *   `DB_CONNECTION`: `mysql` (atau `pgsql`)
    *   `DB_HOST`: (Nilai `MYSQLHOST` dari Railway)
    *   `DB_PORT`: (Nilai `MYSQLPORT` dari Railway)
    *   `DB_DATABASE`: (Nilai `MYSQLDATABASE` dari Railway)
    *   `DB_USERNAME`: (Nilai `MYSQLUSER` dari Railway)
    *   `DB_PASSWORD`: (Nilai `MYSQLPASSWORD` dari Railway)
5.  **PENTING - "Output Directory" Setting**:
    *   Karena Vercel mendeteksi `vite.config.js`, dia mungkin mengira ini project React/Vue dan mencari folder `dist`.
    *   Di setting project Vercel, masuk ke **Settings** -> **Build & Development Settings**.
    *   Pada bagian **Output Directory**, aktifkan **Override** dan isi dengan `public` (atau biarkan kosong jika Anda ingin mengatur via route, tapi `public` biasanya paling aman untuk menghindari error ini). *Rekomendasi: Override dan set ke `public`*.
    *   Jika masih error, coba Override dan biarkan **kosong**.
6.  Klik **"Deploy"**.

### Langkah 3: Migrasi Database
Setelah deploy sukses, database masih kosong. Anda perlu menjalankan migrasi.
Karena Vercel tidak punya terminal SSH yang persisten, cara termudah adalah menghubungkan laptop Anda ke database Railway untuk migrasi.
1.  Di laptop Anda (local), ubah sementara `.env` untuk connect ke Railway (Gunakan data dari Langkah 1).
2.  Jalankan `php artisan migrate --force`.
3.  Kembalikan `.env` ke settingan local Anda.

---

## Opsi 2: Full Deployment di Railway
Jika anda ingin menaruh semuanya (App + Database) di Railway.

1.  Buka [Railway.app](https://railway.app/).
2.  **New Project** -> **Deploy from GitHub repo** -> Pilih `monehive`.
3.  Klik **"Add Variable"** di dashboard project Railway Anda dan masukkan semua isi `.env` lokal Anda (KECUALI `DB_...` yang akan kita set otomatis).
    *   Pastikan `APP_KEY` terisi.
    *   Set `APP_ENV` ke `production`.
    *   Set `APP_DEBUG` ke `false`.
4.  **Tambahkan Database**:
    *   Klik kanan di canvas project Railway -> **New** -> **Database** -> **MySQL**.
    *   Railway otomatis akan menyuntikkan variabel `DATABASE_URL` atau `MYSQL_...` ke aplikasi Laravel Anda.
5.  **Setting Build Command** (Opsional jika gagal):
    *   Railway biasanya otomatis mendeteksi Laravel. Jika tidak, masuk ke Settings -> Build -> Builder pilih **Nixpacks**.
6.  **Domain**: Pergi ke Settings -> Networking -> Generate Domain untuk mendapatkan URL publik.

---

## Debugging

**Jika Vercel Error 500:**
*   Cek **Logs** di dashboard Vercel -> Functions.
*   Biasanya karena salah password database atau `APP_KEY` belum diset.

**Isu Tampilan Rusak / CSS Tidak Muncul (Railway):**
*   **Penyebab 1**: Asset dimuat via HTTP sedangkan web via HTTPS (Mixed Content).
    *   **Solusi**: Di Railway Variables, tambahkan `ASSET_URL` dengan nilai `https://nama-project-anda-production.railway.app` (sesuaikan dengan domain Railway Anda).
*   **Penyebab 2**: Proses Build (`npm run build`) tidak berjalan.
    *   **Solusi**: Di Railway Variables, tambahkan `NIXPACKS_BUILD_CMD` dengan isi:
        `composer install && npm install && npm run build && php artisan view:cache`
    *   Lalu redeploy.

**SOLUSI PAMUNGKAS (Jika Tampilan Masih Rusak): Manual Build**
Jika cara di atas gagal, kita bisa mem-build asset di laptop Anda lalu upload hasilnya.
1.  Di laptop Anda, jalankan:
    ```bash
    npm install
    npm run build
    ```
2.  Buka `.gitignore` dan hapus baris `/public/build` (Sudah saya hapus).
3.  Simpan dan Push hasilnya:
    ```bash
    git add .
    git commit -m "Force commit built assets"
    git push origin main
    ```
4.  Cara ini mem-bypass proses build di Railway yang sering gagal. Pastikan `ASSET_URL` tetap ada di Railway Variables.

**Jika Aset (CSS/JS) tidak muncul:**
*   Pastikan `ASSET_URL` tidak di-set sembarangan di env vars.
*   Pastikan `npm run build` jalan saat deployment (Vercel otomatis menjalankan ini jika terdeteksi `package.json`).
