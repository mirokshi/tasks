<template>
    <v-btn
        v-if="show()"
        v-model="fab"
        color="accent"
        dark
        fab
        fixed
        bottom
        right
        large
        @click="share"
        :disabled="loading"
        :loading="loading"
    >
        <v-icon>share</v-icon>
    </v-btn>
</template>

<script>
export default {
  name: 'ShareFab',
  data () {
    return {
      fab: false,
      loading: false
    }
  },
  methods: {
    show () {
      if (('share' in navigator)) return true
      return false
    },
    share () {
      if (!('share' in navigator)) {
        this.loading = true
        return
      }
      navigator.share({
        title: 'Aplicación de tareas',
        text: 'Aplicacion de gestion de tareas',
        url: 'https://tasks.mirokshi.scool.cat'
      })
        .then(response => {
          console.log('Successful share')
          console.log(response)
          this.loading = false
        }).catch(error => {
          console.log('Error sharing:', error)
          this.loading = false
        })
    }
  }
}
</script>
