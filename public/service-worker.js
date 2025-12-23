const CACHE_NAME = 'monehive-v1';
const urlsToCache = [
    '/',
    '/dashboard',
    '/login',
    '/register',
    '/build/assets/app.css',
    '/build/assets/app.js',
    '/images/logo-m.png',
    '/images/ic_monehive2.png',
    '/manifest.json'
];

// Event 'install': Cache static assets
self.addEventListener('install', (event) => {
    console.log('MoneHive Service Worker Installing...');
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                console.log('Opened cache');
                return cache.addAll(urlsToCache);
            })
            .then(() => self.skipWaiting())
    );
});

// Event 'activate': Clean up old caches
self.addEventListener('activate', (event) => {
    console.log('MoneHive Service Worker Activated');
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Event 'fetch': Network first, fallback to cache
self.addEventListener('fetch', (event) => {
    event.respondWith(
        fetch(event.request)
            .then((response) => {
                // Clone the response
                const responseToCache = response.clone();

                // Cache successful responses
                caches.open(CACHE_NAME).then((cache) => {
                    cache.put(event.request, responseToCache);
                });

                return response;
            })
            .catch(() => {
                // Network failed, try cache
                return caches.match(event.request)
                    .then((response) => {
                        if (response) {
                            return response;
                        }
                        // If not in cache, return offline message
                        return new Response(
                            '<!DOCTYPE html><html><head><title>Offline</title></head><body><h1>Anda sedang Offline</h1><p>Periksa koneksi internet Anda.</p></body></html>',
                            { headers: { 'Content-Type': 'text/html' } }
                        );
                    });
            })
    );
});
