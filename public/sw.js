importScripts("/service-worker/precache-manifest.a66a098ed173865b2f0fdab2229fa827.js", "https://storage.googleapis.com/workbox-cdn/releases/4.1.0/workbox-sw.js");

workbox.setConfig({ debug: true })
workbox.core.skipWaiting()
workbox.core.clientsClaim()

workbox.precaching.cleanupOutdatedCaches()

self.addEventListener('push', (event) => {
  const title = 'Tasks App - Mirokshi Rojas Diaz'
  const options = {
    body: event.data.text()
  }
  event.waitUntil(self.registration.showNotification(title, options))
})

self.addEventListener('sync', function (event) {

})

const showNotification = () => {
  self.registration.showNotification('Post Sent', {
    body: 'You are back online and your post was successfully sent!'
    // icon: 'assets/icon/256.png',
    // badge: 'assets/icon/32png.png'
  })
}

const bgSyncPlugin = new workbox.backgroundSync.Plugin('newsletter', {
  maxRetentionTime: 24 * 60, // Retry for max of 24 Hours
  callbacks: {
    queueDidReplay: showNotification
  }
})

workbox.precaching.precacheAndRoute(self.__precacheManifest)

workbox.routing.registerRoute(
  new RegExp('https://tasks.*/img/*.*(?:jpg|jpeg|png|gif|svg|webp)$'),
  new workbox.strategies.CacheFirst({
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
  new workbox.strategies.NetworkFirst({ cacheName: 'landing' })
)

workbox.routing.registerRoute(
  '/tasques',
  new workbox.strategies.NetworkFirst({ cacheName: 'tasques' })
)

workbox.routing.registerRoute(
  '/api/v1/tasks',
  new workbox.strategies.NetworkFirst({ cacheName: 'api/v1/tasks' })
)

workbox.routing.registerRoute(
  '/api/v1/tasks',
  new workbox.strategies.NetworkOnly({ plugins: [bgSyncPlugin] }),
  'POST'
)

workbox.routing.registerRoute(
  '/api/v1/regular_users',
  new workbox.strategies.NetworkFirst({ cacheName: 'api/v1/regular_users' })
)

workbox.routing.registerRoute(
  '/api/v1/user/unread_notifications ',
  new workbox.strategies.NetworkFirst({ cacheName: 'api/v1/user/unread_notifications' })
)

