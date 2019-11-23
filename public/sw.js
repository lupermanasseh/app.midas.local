var CACHE_STATIC_NAME = "static_v5";
var CACHE_DYNAMIC_NAME = "dynamic_v5";
//Register service worker
self.addEventListener("install", function(event) {
    console.log("[serviceWorker] Installing servcie worker .", event);
    event.waitUntil(
        caches.open(CACHE_STATIC_NAME).then(function(cache) {
            console.log("[service worker] precaching app shell");
            cache.addAll([
                "/Dashboard",
                "/offline",
                "/Dashboard/login",
                "images/logo.png",
                "css/portal.css",
                "js/promise.js",
                "js/fetch.js",
                "/js/custom.js",
                "js/app.js"
            ]);
        })
    );
});

self.addEventListener("activate", function(event) {
    console.log("[serviceWorker] Activating servcie worker .", event);
    //clean up caches
    event.waitUntil(
        caches.keys().then(function(keyList) {
            return Promise.all(
                keyList.map(function(key) {
                    if (
                        key !== CACHE_STATIC_NAME &&
                        key !== CACHE_DYNAMIC_NAME
                    ) {
                        //delete old caches
                        return caches.delete(key);
                    }
                })
            );
        })
    );
    return self.clients.claim();
    //return self.ClientRectList.claim();
});

// self.addEventListener("fetch", function(event) {
//     event.respondWith(
//         caches.match(event.request).then(function(response) {
//             if (response) {
//                 return response;
//             } else {
//                 return fetch(event.request)
//                     .then(function(res) {
//                         //dynamic caching
//                         return caches
//                             .open(CACHE_DYNAMIC_NAME)
//                             .then(function(cache) {
//                                 cache.put(event.request.url, res.clone());
//                                 return res;
//                             });
//                     })
//                     .catch(function(err) {
//                         return caches
//                             .open(CACHE_STATIC_NAME)
//                             .then(function(cache) {
//                                 //provide fallback page
//                                 return cache.match("/offline");
//                             });
//                     });
//             }
//         })
//     );
// });

//Network,cache and  error handling strategy
self.addEventListener("fetch", function(event) {
    event.respondWith(
        fetch(event.request)
            .then(function(res) {
                return caches.open(CACHE_DYNAMIC_NAME).then(function(cache) {
                    cache.put(event.request.url, res.clone());
                    return res;
                });
            })
            .catch(function(err) {
                return caches.match(event.requst).then(function(response) {
                    if (response) {
                        return response;
                    } else {
                        return caches
                            .open(CACHE_STATIC_NAME)
                            .then(function(cache) {
                                //return fallback page
                                return cache.match("/offline");
                            });
                    }
                });
            })
    );
});
