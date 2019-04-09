<template>
    <span>
        <v-btn v-if="!disabled" :loading="sending" :disabled="sending"
               @click="sendNotification">
            Send Notification
        </v-btn>
    </span>
</template>

<script>
export default {
  name: 'PushNotificationButton',
  data () {
    return {
      notificationEnabled: false,
      loading: false,
      loading1: false,
      senfing: false,
      disabled: true,
      disableWatcher: false
    }
  },
  methods: {
    sendNotification () {
      this.sending = true

      window.axios.post('/api/v1/notifications/hello')
        .catch((error) => {
          console.log(error)
          this.sending = false
        })
        .then(() => { this.loading1 = false })
    },
    /**
             * Toggle push notifications subscription.
             */
    togglePush (oldValue) {
      this.loading = true
      if (oldValue) {
        console.log('UNSUBSCRIBING...')
        pushSubscriptions.unsubscribe()
      } else {
        console.log('SUBSCRIBING...')
        pushSubscriptions.subscribe()
      }
    }
  },
  watch: {
    notificationEnabled (notificationEnabled, oldValue) {
      if (!this.disableWatcher) this.togglePush(oldValue)
    }
  },
  created () {
    window.eventBus.$on('pushDisabled', () => {
      console.log('Received event pushDisabled')
      this.disabled = true
    })
    window.eventBus.$on('pushEnabled', () => {
      console.log('Received event pushEnabled')
      this.disabled = false
    })
    window.eventBus.$on('enableNotifications', () => {
      console.log('Received event enableNotifications')
      this.disableWatcher = true
      this.notificationEnabled = true
      this.disableWatcher = false
    })
    window.eventBus.$on('disableNotifications', () => {
      this.disableWatcher = true
      this.notificationEnabled = false
      this.disableWatcher = false
    })
    window.eventBus.$on('pushOperationFinished', () => {
      this.loading = false
    })
  }
}
</script>
