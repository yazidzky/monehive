# 📱 Panduan PWA MoneHive

## Apa itu PWA?

**Progressive Web App (PWA)** adalah aplikasi web yang dapat diinstal seperti aplikasi native di perangkat desktop maupun mobile. MoneHive telah diimplementasikan sebagai PWA sehingga pengguna dapat:

✅ **Install aplikasi di desktop/mobile**  
✅ **Menggunakan aplikasi secara offline**  
✅ **Akses cepat dari home screen**  
✅ **Notifikasi push (opsional)**  
✅ **Update otomatis**

---

## 📋 Fitur PWA yang Telah Diimplementasikan

### 1. **Manifest File** (`public/manifest.json`)
File manifest mendefinisikan bagaimana aplikasi akan terlihat saat diinstal:

- **Name**: MoneHive - Personal Finance Manager
- **Short Name**: MoneHive
- **Theme Color**: #4f46e5 (Indigo)
- **Display Mode**: Standalone (seperti native app)
- **Icons**: 192x192 dan 512x512 pixels
- **Start URL**: /
- **Shortcuts**: Quick access ke Dashboard dan Add Transaction

### 2. **Service Worker** (`public/service-worker.js`)
Service worker mengelola caching dan offline functionality:

- **Caching Strategy**: Network-first, fallback to cache
- **Static Assets Cached**: CSS, JS, Images, Logo
- **Auto-update**: Menghapus cache lama saat update
- **Offline Support**: Menampilkan halaman offline saat tidak ada koneksi

### 3. **Install Prompt**
Tombol install floating di kanan bawah yang muncul otomatis saat aplikasi dapat diinstal.

### 4. **Responsive Design**
Mendukung berbagai ukuran layar dari mobile hingga desktop.

---

## 🖥️ Cara Install PWA di Desktop

### **Google Chrome / Edge / Brave**

1. Buka aplikasi di browser: `http://localhost:8000` atau `https://your-domain.com`
2. Lihat ikon install di address bar (kanan atas) ⊕
3. Klik ikon install atau klik menu (⋮) → **"Install MoneHive"**
4. Klik **Install** pada dialog konfirmasi
5. Aplikasi akan terbuka di window terpisah dan muncul shortcut di desktop

**Atau:**
- Klik tombol **"Install Aplikasi"** yang muncul di kanan bawah halaman

### **Firefox**
Firefox belum mendukung PWA install di desktop, tetapi aplikasi tetap dapat digunakan secara normal di browser.

### **Safari (macOS)**
Safari belum mendukung PWA install di desktop, tetapi aplikasi tetap dapat digunakan secara normal di browser.

---

## 📱 Cara Install PWA di Mobile

### **Android (Chrome / Edge / Samsung Internet)**

1. Buka aplikasi di browser mobile
2. Klik menu (⋮) di kanan atas
3. Pilih **"Add to Home screen"** atau **"Install app"**
4. Klik **Add** atau **Install**
5. Ikon aplikasi akan muncul di home screen
6. Tap ikon untuk membuka aplikasi dalam mode standalone

**Atau:**
- Tap tombol **"Install Aplikasi"** yang muncul di halaman

### **iOS (Safari)**

1. Buka aplikasi di Safari
2. Tap tombol **Share** (kotak dengan panah ke atas) di bawah
3. Scroll dan pilih **"Add to Home Screen"**
4. Ubah nama jika perlu, lalu tap **Add**
5. Ikon aplikasi akan muncul di home screen

> **Note**: iOS Safari mendukung PWA, tetapi dengan beberapa keterbatasan dibanding Android

---

## 🔧 Cara Menghapus PWA yang Terinstal

### **Desktop (Chrome/Edge)**
1. Buka aplikasi yang terinstal
2. Klik menu (⋮) di kanan atas
3. Pilih **"Uninstall MoneHive"** atau **"Remove from Chrome"**
4. Konfirmasi uninstall

### **Android**
1. Tekan dan tahan ikon aplikasi di home screen
2. Pilih **"Uninstall"** atau drag ke **"Uninstall"**
3. Konfirmasi uninstall

### **iOS**
1. Tekan dan tahan ikon aplikasi
2. Pilih **"Remove App"**
3. Pilih **"Delete from Home Screen"** atau **"Delete App"**

---

## 🚀 Testing PWA

### **1. Test di Localhost**

Jalankan aplikasi:
```bash
php artisan serve
```

Akses di browser:
```
http://localhost:8000
```

> **Note**: PWA install hanya berfungsi dengan HTTPS atau `localhost`

### **2. Test dengan Chrome DevTools**

1. Buka **Chrome DevTools** (F12)
2. Pilih tab **"Application"**
3. Di sidebar kiri, cek:
   - **Manifest**: Pastikan manifest terbaca dengan benar
   - **Service Workers**: Pastikan service worker aktif (status: activated)
   - **Cache Storage**: Lihat assets yang di-cache
4. Klik **"Update on reload"** untuk testing update service worker
5. Klik **"Offline"** di tab Network untuk test offline mode

### **3. Lighthouse Audit**

1. Buka **Chrome DevTools** (F12)
2. Pilih tab **"Lighthouse"**
3. Pilih **"Progressive Web App"**
4. Klik **"Generate report"**
5. Lihat skor PWA dan rekomendasi improvement

**Target PWA Score**: Minimal 80/100

---

## 📊 PWA Checklist

✅ **Manifest.json** - Ada dan valid  
✅ **Service Worker** - Registered dan aktif  
✅ **HTTPS** - Required untuk production (localhost OK untuk dev)  
✅ **Responsive Design** - Mendukung mobile dan desktop  
✅ **Icons** - 192x192 dan 512x512 pixels  
✅ **Theme Color** - Defined  
✅ **Offline Support** - Basic offline functionality  
✅ **Install Prompt** - Custom install button  
✅ **Meta Tags** - Viewport, theme-color, apple-mobile-web-app  

---

## 🌐 Deploy PWA ke Production

### **Requirements untuk PWA Production**

1. **HTTPS Required**: PWA hanya berfungsi dengan HTTPS
2. **Valid SSL Certificate**: Gunakan Let's Encrypt (gratis)
3. **Service Worker**: Sudah terimplementasi ✅
4. **Manifest**: Sudah terimplementasi ✅

### **Platform Deployment yang Direkomendasikan**

#### **1. Railway (Recommended - Free Tier)**
```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Deploy
railway up
```

Railway otomatis menyediakan HTTPS, jadi PWA langsung berfungsi.

#### **2. Heroku**
```bash
# Login
heroku login

# Create app
heroku create monehive

# Deploy
git push heroku main
```

Heroku juga otomatis menyediakan HTTPS.

#### **3. VPS Manual (DigitalOcean, Vultr, dll)**

Setup Nginx dengan SSL:
```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Get SSL Certificate
sudo certbot --nginx -d your-domain.com

# Certbot akan otomatis konfigurasi HTTPS di Nginx
```

---

## 🎯 Keuntungan PWA untuk User

### **Desktop**
- ✅ Install seperti aplikasi native
- ✅ Akses cepat dari taskbar/dock
- ✅ Window terpisah tanpa browser toolbar
- ✅ Notifikasi desktop (opsional)
- ✅ Auto-update tanpa manual download

### **Mobile**
- ✅ Ikon di home screen
- ✅ Splash screen saat launch
- ✅ Fullscreen mode (tanpa browser UI)
- ✅ Offline functionality
- ✅ Ukuran lebih kecil dari native app
- ✅ Tidak perlu download dari Play Store/App Store

---

## 📝 Troubleshooting

### **PWA tidak muncul opsi install**

**Penyebab:**
1. Bukan HTTPS (kecuali localhost)
2. Manifest.json tidak valid
3. Service Worker tidak registered
4. Browser tidak support (Firefox desktop, Safari desktop)

**Solusi:**
1. Deploy ke hosting dengan HTTPS atau test di localhost
2. Validasi manifest di Chrome DevTools → Application → Manifest
3. Cek Service Worker di Chrome DevTools → Application → Service Workers
4. Gunakan Chrome/Edge untuk testing

### **Service Worker tidak update**

**Solusi:**
1. Ubah `CACHE_NAME` di `service-worker.js` (misal: `monehive-v2`)
2. Hard refresh browser (Ctrl+Shift+R atau Cmd+Shift+R)
3. Chrome DevTools → Application → Service Workers → Unregister
4. Clear cache dan reload

### **Offline mode tidak berfungsi**

**Solusi:**
1. Pastikan Service Worker sudah activated
2. Cek cache storage di Chrome DevTools
3. Test dengan Chrome DevTools → Application → Service Workers → Offline checkbox

### **Icon tidak muncul saat install**

**Solusi:**
1. Pastikan file icon ada di `public/images/ic_monehive2.png`
2. Check ukuran icon minimal 192x192 dan 512x512
3. Validasi manifest di Chrome DevTools

---

## 🔍 Referensi Tambahan

- [PWA Documentation - Google](https://web.dev/progressive-web-apps/)
- [Service Worker API - MDN](https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API)
- [Web App Manifest - MDN](https://developer.mozilla.org/en-US/docs/Web/Manifest)
- [Workbox - PWA Library](https://developers.google.com/web/tools/workbox)

---

## 📞 Support

Jika mengalami masalah dengan PWA, buka browser DevTools (F12) dan periksa:
1. Console untuk error messages
2. Application tab untuk manifest dan service worker status
3. Network tab untuk cache hits

Happy coding! 🚀
