<template>
    <span>
        <v-navigation-drawer
            v-model="dataDrawerRight"
            fixed
            right
            clipped
            app
        >
            <v-card>
                <v-card-title class="grey darken-3 white--text"><h4>Perfil</h4></v-card-title>
                <v-layout row wrap>
                    <v-flex xs12>
                        <ul>
                            <li>Nombre : {{dataUser.name}}</li>
                            <li>Email : {{dataUser.email}}</li>
                            <li>Admin : {{ dataUser.admin ? 'SI' : 'NO' }}</li>
                            <li>Roles : {{ implode(',',dataUser.map()['roles']) }}</li>
                            <li>Permissions : {{ implode(', ',dataUser.map()['permissions']) }}</li>
                        </ul>
                    </v-flex>
                </v-layout>
            </v-card>
            <!--<v-card>-->
                <!--<v-card-title class="grey darken-3 white&#45;&#45;text"><h4>Opciones de administrador</h4></v-card-title>-->

                <!--<v-layout row wrap>-->
                    <!--@impersonating-->
                    <!--<v-flex xs12>-->
                        <!--<v-avatar title="{{ dataUser.impersonatedBy().name }} ( {{ dataUser.email }} )">-->
                            <!--<img src="https://www.gravatar.com/avatar/{{ md5(dataUser.impersonatedBy().email) }}" alt="avatar">-->
                        <!--</v-avatar>-->
                    <!--</v-flex>-->
                    <!--@endImpersonating-->
                    <!--<v-flex xs12>-->
                        <!--@canImpersonate-->
                        <!--<impersonate label="Entrar como..." url="/api/v1/regular_users"></impersonate>-->
                        <!--@endCanImpersonate-->
                        <!--@impersonating-->
                        <!--{{ dataUser().impersonatedBy.name }} està suplantant {{ dataUser.name }}-->
                        <!--<a href="/impersonate/leave">Abandonar la suplantación</a>-->
                        <!--@endImpersonating-->
                    <!--</v-flex>-->
                <!--</v-layout>-->
            <!--</v-card>-->
            <!--<tema></tema>-->
            <!--<v-form action="/logout" method="POST">-->
                <!--<v-btn color="indigo lighten-2" class="text-md-center" type="submit" ><v-icon>exit_to_app</v-icon>CERRAR SESION</v-btn>-->
            <!--</v-form>-->
        </v-navigation-drawer>
    </span>
</template>

<script>
import Impersonate from './Impersonate'
import Tema from './Tema'

export default {
  name: 'NavigationRight',
  data () {
    return {
      dataDrawerRight: this.drawerRight,
      dataUser: this.user
    }
  },
  components: {
    'impersonate': Impersonate,
    'tema': Tema
  },
  props: {
    user: {
      type: Object,
      required: true
    },
    drawerRight: {
      Type: Boolean,
      default: false
    }
  }
}
</script>

<style scoped>

</style>
