/**
 * Mengimpor file konfigurasi bootstrap/inisialisasi dasar.
 */
import './bootstrap';

/**
 * Alpine.js - Kerangka kerja JavaScript ringan untuk interaktivitas frontend.
 */
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Memulai Alpine.js
Alpine.start();

/**
 * Pendaftaran Service Worker untuk kemampuan Progressive Web App (PWA).
 * Memeriksa apakah browser mendukung layanan pekerja, lalu mendaftarkannya.
 */
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js')
            .then(() => console.log('Service Worker registered'))
            .catch(err => console.log('SW registration failed', err));
    });
}
