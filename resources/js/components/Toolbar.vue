<template>
    <v-toolbar color="primary" dark fixed app clipped-right clipped-left>
        <v-toolbar-side-icon @click.stop="$emit('toggle-left')"></v-toolbar-side-icon>
        <v-toolbar-title>Menú</v-toolbar-title>
        <v-spacer></v-spacer>

        <notifications-widget></notifications-widget>

        <span class="mr-4 hidden-xs-only" v-role="'SuperAdmin'"><git-info></git-info></span>
        <span class="dotO" title="Usuario Conectado" v-if="user.online"></span>
        <span class="dotI" title="Usuario Desconectado" v-else></span>

        <v-avatar @click="$emit('toggle-right')" :title="user.name">
            <img :src=userAvatar alt="avatar">
        </v-avatar>
        <v-form action="logout" method="POST">
            <input type="hidden" name="_token" :value="csrfToken">
            <v-btn type="submit" icon><v-icon>exit_to_app</v-icon></v-btn>
        </v-form>
    </v-toolbar>
</template>

<script>
import NotificationsWidget from './notifications/NotificationsWidget.vue'
import GitInfoComponent from './git/GitInfoComponent.vue'

export default {
  name: 'MainToolbar',
  components: {
    'notifications-widget': NotificationsWidget,
    'git-info': GitInfoComponent
  },
  data () {
    return {
      userAvatar: window.laravel_user.gravatar
    }
  },
  props: {
    csrfToken: {
      Type: String,
      required: true
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
