importScripts("/service-worker/precache-manifest.ef2e2cc00aad0930650465213a8a053e.js", "https://storage.googleapis.com/workbox-cdn/releases/4.1.1/workbox-sw.js");

workbox.setConfig({
  debug: true
})

// workbox.skipWaiting()
// workbox.clientsClaim()

// 4.0
workbox.core.skipWaiting()
workbox.core.clientsClaim()
workbox.precaching.cleanupOutdatedCaches()

// workbox.routing.registerRoute(
//   new RegExp('https://hacker-news.firebaseio.com'),
//   workbox.strategies.staleWhileRevalidate()
// );

// // TODO cal utilitzar PushManager al registrar el service worker
// self.addEventListener('push', (event) => {
//   const title = 'Tasks Mirokshi'
//   const options = {
//     body: event.data.text()
//   }
//   event.waitUntil(self.registration.showNotification(title, options))
// })
// self.addEventListener('sync', function (event) {
//
// })

const showNotification = () => {
  self.registration.showNotification('Post Sent', {
    body: 'You are back online and your post was successfully sent!'
    // icon: 'assets/icon/256.png',
    // badge: 'assets/icon/32png.png'
  })
}

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
  new workbox.strategies.StaleWhileRevalidate({ cacheName: 'tasques' })
)

workbox.routing.registerRoute(
  new RegExp('/api/'),
  new workbox.strategies.NetworkFirst({ cacheName: 'api' })
)

const bgSyncPlugin = new workbox.backgroundSync.Plugin('newsletter', {
  maxRetentionTime: 24 * 60, // Retry for max of 24 Hours
  callbacks: {
    queueDidReplay: showNotification
  }
})

workbox.routing.registerRoute(
  '/api/v1/newsletter',
  new workbox.strategies.NetworkOnly({
    cacheName: 'api',
    plugins: [bgSyncPlugin]
  }),
  'POST'
)
// const showNotification = () => {
//   self.registration.showNotification('Post Sent', {
//     body: 'You are back online and your post was successfully sent!'
//     // icon: 'assets/icon/256.png',
//     // badge: 'assets/icon/32png.png'
//   })
// }
//
// const bgSyncPlugin = new workbox.backgroundSync.Plugin('newsletter', {
//   maxRetentionTime: 24 * 60, // Retry for max of 24 Hours
//   callbacks: {
//     queueDidReplay: showNotification
//   }
// })

workbox.routing.registerRoute(
  '/api/v1/newsletter',
  new workbox.strategies.NetworkOnly({
    plugins: [bgSyncPlugin]
  }),
  'POST'
)

const WebPush = {
  init () {
    self.addEventListener('push', this.notificationPush.bind(this))
    self.addEventListener('notificationclick', this.notificationClick.bind(this))
    self.addEventListener('notificationclose', this.notificationClose.bind(this))
  },

  /**
     * Handle notification push event.
     *
     * https://developer.mozilla.org/en-US/docs/Web/Events/push
     *
     * @param {NotificationEvent} event
     */
  notificationPush (event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
      return
    }

    // https://developer.mozilla.org/en-US/docs/Web/API/PushMessageData
    if (event.data) {
      event.waitUntil(
        this.sendNotification(event.data.json())
      )
    }
  },

  /**
     * Handle notification push event.
     *
     * https://developer.mozilla.org/en-US/docs/Web/Events/push
     *
     * @param {NotificationEvent} event
     */
  notificationClick (event) {
    if (!event.action) {
      if (event.notification.data) {
        if (event.notification.data.url) {
          promiseChain = self.clients.openWindow(event.notification.data.url)
          event.waitUntil(promiseChain)
          return
        }
      }
      promiseChain = self.clients.openWindow('/')
      event.waitUntil(promiseChain)
      return
    }

    // https://developer.mozilla.org/en-US/docs/Web/API/PushMessageData
    switch (event.action) {
      case 'open_url':
        if (event.notification.data) {
          if (event.notification.data.url) {
            promiseChain = self.clients.openWindow(event.notification.data.url)
            event.waitUntil(promiseChain)
            break
          }
        }
        break
      case 'other_action':
        break
      default:
        console.log(`Unknown action clicked: '${event.action}'`)
        break
    }
  },

  /**
     * Handle notification close event (Chrome 50+, Firefox 55+).
     *
     * https://developer.mozilla.org/en-US/docs/Web/API/ServiceWorkerGlobalScope/onnotificationclose
     *
     * @param {NotificationEvent} event
     */
  notificationClose (event) {
    self.registration.pushManager.getSubscription().then(subscription => {
      if (subscription) {
        this.dismissNotification(event, subscription)
      }
    })
  },

  /**
     * Send notification to the user.
     *
     * https://developer.mozilla.org/en-US/docs/Web/API/ServiceWorkerRegistration/showNotification
     *
     * @param {PushMessageData|Object} data
     */
  sendNotification (data) {
      console.log('hola send push');
      return self.registration.showNotification(data.title, data)
  },

  /**
     * Send request to server to dismiss a notification.
     *
     * @param  {NotificationEvent} event
     * @param  {String} subscription.endpoint
     * @return {Response}
     */
  dismissNotification ({ notification }, { endpoint }) {
    console.log('dismissNotification triggered!')
    if (!notification.data || !notification.data.id) {
      return
    }

    const data = new FormData()
    data.append('endpoint', endpoint)

    // Send a request to the server to mark the notification as read.
    fetch(`/api/v1/unread_notifications/${notification.data.id}`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      method: 'POST',
      body: data
    })
  }
}
WebPush.init()

