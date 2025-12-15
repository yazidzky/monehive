# Konfigurasi Procfile (Heroku/Railway)
# Mendefinisikan perintah yang dijalankan server saat start.
# 1. chmod 777 storage: Memastikan folder penyimpanan bisa ditulisi.
# 2. migrate --force: Menjalankan migrasi database otomatis.
# 3. artisan serve: Menjalankan server aplikasi.
web: chmod -R 777 storage bootstrap/cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
