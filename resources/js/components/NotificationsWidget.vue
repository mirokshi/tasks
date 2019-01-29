<template>
    <v-menu offset-y>
        <v-btn icon flat slot="activator">
            <v-badge left color="red" overlap><span slot="badge">6</span>
                <v-icon>notifications_none</v-icon>
            </v-badge>
        </v-btn>
        <v-list>
            <v-list-tile @click="notify">
                NOTIFY
            </v-list-tile>
            <v-list-tile>
                <v-tooltip bottom>
                    <span slot="activator">Notificacion</span>
                    <span>sshvsjhvssjvjs</span>
                </v-tooltip>
            </v-list-tile>
            <v-list-tile>
                <v-list-tile-title>Notification 2</v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
                <v-list-tile-title>Notification 3</v-list-tile-title>
            </v-list-tile>
        </v-list>
    </v-menu>
</template>

<script>
export default {
  name: 'NotificationsWidget',
  methods: {
    notify () {
      if (!('Notification' in window)) {
        this.$snackbar.showError('This browser does not support desktop notification')
      } else {
        if (Notification.permission === 'default') {
          Notification.requestPermission().then(function (result) {
            console.log(result)
          })
        }
        console.log(Notification.permission)
        if (Notification.permission === 'granted') {
          new Notification('Hi there!')
        }
      }
    }
  }

}
</script>

<style scoped>

</style>
