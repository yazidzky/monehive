self.addEventListener("install", (event) => {
    console.log("MoneHive Service Worker Installed");
});

self.addEventListener("fetch", (event) => {
    event.respondWith(
        fetch(event.request).catch(() => {
            // di sini nanti bisa diarahkan ke halaman offline
            return new Response("Offline");
        })
    );
});
