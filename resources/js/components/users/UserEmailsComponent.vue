<template>
    <v-menu offset-y>
            <v-tooltip bottom slot="activator">
                <v-btn  slot="activator"
                        icon
                        style="margin: 0px"
                        :loading="loading"
                        :disabled="loading">
                    <v-icon color="primary">email</v-icon>
                </v-btn>
                <span>Enviar emails</span>
            </v-tooltip>
        <v-list>
            <v-list-tile @click="reset">
                <v-list-tile-title>Restauració paraula de pas</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="confirm">
                <v-list-tile-title>Confirmació email personal</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="sendMobileVerification">
                <v-list-tile-title>Confirmació SMS telèfon</v-list-tile-title>
            </v-list-tile>
        </v-list>
    </v-menu>
</template>

<script>
export default {
  name: 'UserEmails',
  data () {
    return {
      loading: false,
      email: null
    }
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  methods: {
    confirm () {
      this.loading = true
      window.axios.get('/email/resend').then((response) => {
        this.loading = false
        this.$snackbar.showMessage('Email de confirmacion enviado')
      }).catch(() => {
        this.loading = false
      })
    },
    reset () {
      this.loading = true
      window.axios.post('/password/' + this.user.email).then((response) => {
        console.log(this.user.email)
        this.loading = false
        this.$snackbar.showMessage('Email para restaurar la contraseña enviado')
      }).catch(() => {
        this.loading = false
      })
    },
    sendMobileVerification () {
      this.loading = true
      window.axios.post('/api/v1/users/' + this.user.id + '/send_mobile_verification').then((response) => {
        this.loading = false
        this.$snackbar.showMessage('SMS enviado')
      }).catch(() => {
        this.loading = false
      })
    }
  }
}
</script>
