<template>
    <span>
        <v-toolbar
            color="primary"
            dark
            app
            clipped-left
            clipped-right
            fixed
            style="background: #2680C2;background: -webkit-linear-gradient(to right, #2680C2, #186FAF);
            background: linear-gradient(to right, #2680C2, #186FAF);"
        >
            <v-toolbar-side-icon @click="$emit('toggleLeft')"></v-toolbar-side-icon>
            <v-toolbar-title v-if="$vuetify.breakpoint.mdAndUp">
                {{title}}
            </v-toolbar-title>
            <v-spacer></v-spacer>

            <notifications-widget></notifications-widget>

            <span v-role="'SuperAdmin'" v-if="$vuetify.breakpoint.mdAndUp">
                <git-info></git-info>
            </span>
            <v-btn href="/profile" icon flat>
            <v-avatar  :title="user.name">
                <img :src="user.gravatar" alt="avatar">
            </v-avatar>
            </v-btn>
            <v-btn @click="$emit('toggleRight')" icon flat><v-icon>reorder</v-icon></v-btn>
        </v-toolbar>
    </span>
</template>

<script>
import NotificationsWidget from './notifications/NotificationsWidget'
import GitInfoComponent from './git/GitInfoComponent'

export default {
  name: 'Toolbar',
  components: {
    'notifications-widget': NotificationsWidget,
    'git-info': GitInfoComponent
  },
  props: {
    title: {
      type: String,
      defaul: 'Titulo'
    }
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>

<style scoped>

</style>
