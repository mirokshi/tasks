<template>
    <v-navigation-drawer
        v-model="dataDrawer"
        fixed
        right
        clipped
        app
    >
        <v-card>
            <v-card-title class="primary white--text"><h4>Perfil</h4></v-card-title>
            <v-list-tile class="pb-2 pt-2">
                <v-list-tile-avatar>
                    <v-avatar>
                        <img :title="user.name" :src="user.gravatar">
                    </v-avatar>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>{{user.name}}</v-list-tile-title>
                    <v-list-tile-title>{{user.email}}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list-tile class="pb-2 pt-2">
                <v-list-tile-content>
                    <v-list-tile-title>Administrador? {{ user.admin ? 'Si' : 'No' }}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list>
                <v-list-group v-ripple no-action>
                    <v-list-tile slot="activator">
                        <v-list-tile-content>Rols</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile v-for="rol in user.roles" :key="rol">
                        <v-list-tile-content>
                            <v-list-tile-title>{{ rol }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-divider></v-divider>
                <v-list-group v-ripple no-action>
                    <v-list-tile slot="activator">
                        <v-list-tile-content>Permisos</v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile v-for="permis in user.permissions" :key="permis">
                        <v-list-tile-content>
                            <v-list-tile-title>{{ permis }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
            </v-list>
        </v-card>
        <v-card>
            <v-flex class="subheading">
                <v-card-title class="primary white--text"><h4>Opcions administrador</h4>

                    <v-flex v-if="isImpersonating">
                        <v-btn  title="Abandonar suplantació" href="impersonate/leave" flat class="white--text" icon><v-icon>exit_to_app</v-icon></v-btn>
                    </v-flex>
                </v-card-title>

                <v-flex xs12 v-if="canImpersonate">
                    <impersonate label="Entrar com..." url="/api/v1/regular_users"></impersonate>
                </v-flex>

                <v-flex v-if="isImpersonating">
                    <v-layout row wrap>
                        <v-card-text class="text-xs-center subheading">
                            <v-flex>
                                <v-avatar :title="impersonatedBy.name +' '+'( '+impersonatedBy.email+' )'">
                                    <img :src="gravatar" alt="avatar">
                                </v-avatar>
                            </v-flex>
                            <v-flex class="mt-2 ml-1 mr-1">

                                {{ impersonatedBy.name }} està suplantant a {{ user.name }}
                            </v-flex>
                        </v-card-text>
                    </v-layout>
                </v-flex>

            </v-flex>
        </v-card>
        <v-card>
            <v-card-title class="primary white--text"><h4>Colors del tema</h4></v-card-title>
            <tema></tema>
        </v-card>
    </v-navigation-drawer>
</template>

<script>
import Tema from './Tema'
import Impersonate from './Impersonate'

export default {
  components: {
    'tema': Tema,
    'impersonate': Impersonate
  },
  name: 'NavigationRight',
  data () {
    return {
      dataDrawer: this.drawerRight
    }
  },
  props: {
    drawerRight: {
      Type: Boolean,
      default: null
    },
    csrfToken: {
      Type: String
    }
  },
  watch: {
    dataDrawer (newval) {
      this.$emit('input', newval)
    },
    drawerRight (newval) {
      this.dataDrawer = newval
    }
  },
  model: {
    prop: 'drawerRight',
    event: 'input'
  },
  computed: {
    isImpersonating: function () {
      return !!window.impersonatedBy
    },
    canImpersonate: function () {
      return window.laravel_user.admin || false
    },
    gravatar: function () {
      return (
        'https://www.gravatar.com/avatar/' +
                    window.md5(
                      window.impersonatedBy
                        ? window.impersonatedBy.email
                        : 'google@gmail.com'
                    )
      )
    },
    user: function () {
      return window.laravel_user
    },
    impersonatedBy: function () {
      return window.impersonatedBy || undefined
    }
  }
}
</script>
