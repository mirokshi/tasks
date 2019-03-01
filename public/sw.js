importScripts("/service-worker/precache-manifest.fda7440b6e9c2c667243c06cd5555250.js", "https://storage.googleapis.com/workbox-cdn/releases/4.0.0/workbox-sw.js");

workbox.skipWaiting()
workbox.clientsClaim()

workbox.setConfig({
  debug: true
})

workbox.routing.registerRoute(
  '/',
  workbox.strategies.staleWhileRevalidate({ cacheName: 'landing' })
)

// TODO cal utilitzar PushManager al registrar el service worker
self.addEventListener('push', (event) => {
  const title = 'TODO CANVIAR TITOL'
  const options = {
    body: event.data.text()
  }
  event.waitUntil(self.registration.showNotification(title, options))
})

workbox.precaching.precacheAndRoute(self.__precacheManifest)
// workbox.precaching.precacheAndRoute([]) També funciona i workbox substitueix pel que pertoca -> placeholder

// static
workbox.routing.registerRoute(
  new RegExp('.(?:ico)$'),
  workbox.strategies.networkFirst({
    cacheName: 'icons'
  })
)

// images
workbox.routing.registerRoute(
  new RegExp('/img/*.*(?:jpg|jpeg|png|gif|svg|webp)$'),
  workbox.strategies.cacheFirst({
    cacheName: 'images',
    plugins: [
      new workbox.expiration.Plugin({
        maxEntries: 20,
        purgeOnQuotaError: true
      })
    ]
  })
)

workbox.routing.registerRoute(
  '/',
  workbox.strategies.staleWhileRevalidate({ cacheName: 'landing' })
)

// NO ENS CAL PQ LES TENIM INTEGRADES EN LOCAL VIA WEBPACK i NMP IMPORTS
// // fonts
// workbox.routing.registerRoute(
//   new RegExp('https://fonts.*'),
//   workbox.strategies.cacheFirst({
//     cacheName: 'fonts',
//     plugins: [
//       new workbox.cacheableResponse.Plugin({
//         statuses: [0, 200]
//       })
//     ]
//   })
// )
//
// // google stuff
// workbox.routing.registerRoute(
//   new RegExp('.*(?:googleapis|gstatic).com.*$'),
//   workbox.strategies.networkFirst({
//     cacheName: 'google'
//   })
// )
//
// // static
// workbox.routing.registerRoute(
//   new RegExp('.(?:js|css|ico)$'),
//   workbox.strategies.networkFirst({
//     cacheName: 'static'
//   }),
// )
//
// // images
// workbox.routing.registerRoute(
//   new RegExp('.(?:jpg|png|gif|svg)$'),
//   workbox.strategies.cacheFirst({
//     cacheName: 'images',
//     plugins: [
//       new workbox.expiration.Plugin({
//         maxEntries: 20,
//         purgeOnQuotaError: true,
//       })
//     ]
//   })

