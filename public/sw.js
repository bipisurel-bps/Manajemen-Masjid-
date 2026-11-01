// SAF — Service Worker (safmasjid.web.id)
// Offline Cache & Full PWA Support for Mosque Management System
const CACHE_NAME = 'saf-masjid-v1';

const STATIC_ASSETS = [
    '/',
    '/offline.html',
    '/manifest.json',
    '/favicon.ico',
    '/icon-192.png',
    '/icon-512.png'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(async cache => {
            // Precache core static shell
            await cache.addAll(STATIC_ASSETS);

            // Dynamically precache Vite build bundle assets (CSS, JS, Fonts)
            try {
                const manifestRes = await fetch('/build/manifest.json');
                if (manifestRes.ok) {
                    const manifest = await manifestRes.json();
                    const buildAssets = [];
                    for (const key in manifest) {
                        if (manifest[key].file) {
                            buildAssets.push('/build/' + manifest[key].file);
                        }
                        if (Array.isArray(manifest[key].assets)) {
                            manifest[key].assets.forEach(asset => buildAssets.push('/build/' + asset));
                        }
                    }
                    if (buildAssets.length > 0) {
                        await cache.addAll([...new Set(buildAssets)]);
                    }
                }
            } catch (err) {
                console.warn('[SW] Could not precache assets from /build/manifest.json:', err);
            }
        })
    );
    self.skipWaiting();
});

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys =>
            Promise.all(
                keys.map(key => {
                    if (key !== CACHE_NAME) {
                        return caches.delete(key);
                    }
                })
            )
        )
    );
    self.clients.claim();
});

self.addEventListener('fetch', event => {
    const { request } = event;

    // Only handle GET requests
    if (request.method !== 'GET') return;

    const url = new URL(request.url);

    // Only handle requests from the same origin
    if (url.origin !== self.location.origin) return;

    // 1. Static hashed assets (/build/assets/): Cache-First strategy
    if (url.pathname.startsWith('/build/assets/')) {
        event.respondWith(
            caches.match(request).then(cached => {
                if (cached) return cached;
                return fetch(request).then(response => {
                    if (response.ok) {
                        const clone = response.clone();
                        caches.open(CACHE_NAME).then(c => c.put(request, clone));
                    }
                    return response;
                });
            })
        );
        return;
    }

    // 2. HTML Page Navigation: Network-First with Cache Fallback and Offline Page Fallback
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request)
                .then(response => {
                    if (response.ok) {
                        const clone = response.clone();
                        caches.open(CACHE_NAME).then(c => c.put(request, clone));
                    }
                    return response;
                })
                .catch(async () => {
                    const cached = await caches.match(request);
                    if (cached) return cached;
                    const offlineFallback = await caches.match('/offline.html');
                    return offlineFallback || caches.match('/');
                })
        );
        return;
    }

    // 3. Other local assets (images, icons, manifest): Stale-While-Revalidate
    event.respondWith(
        caches.match(request).then(cached => {
            const networkFetch = fetch(request).then(response => {
                if (response.ok) {
                    const clone = response.clone();
                    caches.open(CACHE_NAME).then(c => c.put(request, clone));
                }
                return response;
            }).catch(() => cached);

            return cached || networkFetch;
        })
    );
});
