<template>
    <v-toolbar color="primary" dark fixed app clipped-right clipped-left>
        <v-toolbar-side-icon @click.stop="$emit('toggle-left')"></v-toolbar-side-icon>
        <v-toolbar-title>Menú</v-toolbar-title>
        <v-spacer></v-spacer>

        <user-online-widget></user-online-widget>
        <notifications-widget></notifications-widget>

        <span class="mr-4 hidden-xs-only" v-role="'SuperAdmin'"><git-info></git-info></span>
        <span class="dotO" title="Usuario Conectado" v-if="user.online"></span>
        <span class="dotI" title="Usuario Desconectado" v-else></span>

        <v-avatar @click="$emit('toggle-right')" :title="user.name">
            <img :src=userAvatar alt="avatar">
        </v-avatar>
    </v-toolbar>
</template>

<script>
import NotificationsWidget from './notifications/NotificationsWidget.vue'
import GitInfoComponent from './git/GitInfoComponent.vue'
import UserOnlineWidget from "./UserOnlineWidget";

export default {
  name: 'Toolbar',
  components: {
    'notifications-widget': NotificationsWidget,
    'git-info': GitInfoComponent,
      'user-online-widget':UserOnlineWidget
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
    .dotO{
        height: 15px;
        width: 15px;
        background-color: #388a11;
        border-radius: 50%;
        display: inline-block;
        margin-left: 9px;
        margin-right: 9px;
    }
    .dotI{
        height: 15px;
        width: 15px;
        background-color: #730500;
        border-radius: 50%;
        display: inline-block;
        margin-left: 9px;
        margin-right: 9px;
    }
</style>
