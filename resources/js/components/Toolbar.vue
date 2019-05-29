<template>
    <v-toolbar color="primary" dark fixed app clipped-right clipped-left>
        <v-toolbar-side-icon @click.stop="$emit('toggle-left')"></v-toolbar-side-icon>
        <v-toolbar-title>Menú</v-toolbar-title>
        <v-spacer></v-spacer>

        <user-online-widget></user-online-widget>
        <notifications-widget></notifications-widget>

        <span class="mr-4 hidden-xs-only" v-role="'SuperAdmin'"><git-info></git-info></span>

        <v-avatar @click="$emit('toggle-right')" :title="user.name">
            <img :src=userAvatar alt="avatar">
        </v-avatar>
    </v-toolbar>
</template>

<script>
import NotificationsWidget from './notifications/NotificationsWidget.vue'
import GitInfoComponent from './git/GitInfoComponent.vue'
import UserOnlineWidget from './users/UserOnlineWidget'

export default {
  name: 'Toolbar',
  components: {
    'notifications-widget': NotificationsWidget,
    'git-info': GitInfoComponent,
    'user-online-widget': UserOnlineWidget
  },
  data () {
    return {
      userAvatar: window.laravel_user.gravatar
    }
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>
<style scoped>

</style>
