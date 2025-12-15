// Event 'install': Dijalankan saat Service Worker pertama kali diinstal oleh browser.
// Ini adalah bagian dari siklus hidup PWA (Progressive Web App).
self.addEventListener("install", (event) => {
    console.log("MoneHive Service Worker Installed");
    // Di sini kita bisa melakukan caching asset statis (HTML, CSS, JS, Images)
    // agar aplikasi bisa berjalan offline.
});

// Event 'fetch': Dijalankan setiap kali aplikasi meminta resource (Network Request).
// Kita bisa memanipulasi request di sini, misalnya menyajikan konten dari Cache jika offline.
self.addEventListener("fetch", (event) => {
    event.respondWith(
        fetch(event.request).catch(() => {
            // Fallback jika tidak ada koneksi internet (Offline)
            // Bisa menampilkan halaman 'offline.html' kustom atau pesan sederhana.
            return new Response("Anda sedang Offline. Periksa koneksi internet Anda.");
        })
    );
});
