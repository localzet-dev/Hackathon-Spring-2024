/**
 * @package     Triangle Web
 * @link        https://github.com/Triangle-org
 *
 * @copyright   2018-2024 Localzet Group
 * @license     https://mit-license.org MIT
 */

self.addEventListener('install', function(event) {
    // event.waitUntil(
    //     caches.open('v1').then(function(cache) {
    //         return cache.addAll([
    //             '/assets/js/main_api.js',
    //             '/favicon.png',
    //             '/oggetto-192x192.png',
    //             '/oggetto-512x512.png'
    //         ]);
    //     })
    // );
});

// self.addEventListener('fetch', function(event) {
//     event.respondWith(
//         caches.match(event.request).then(function(response) {
//             if (response !== undefined) {
//                 return response;
//             } else {
//                 return fetch(event.request).then(function (response) {
//                     let responseClone = response.clone();
//
//                     caches.open('v1').then(function (cache) {
//                         cache.put(event.request, responseClone);
//                     });
//
//                     return response;
//                 }).catch(function () {
//                     return caches.match('/');
//                 });
//             }
//         })
//     );
// });
