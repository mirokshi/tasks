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
        onclick="share"
    >
        <v-icon>share</v-icon>
    </v-btn>
</template>

<script>
export default {
  name: 'ShareFab',
  data: function () {
    return {
      fab: false
    }
  },
  methods: {
    show () {
      if (('share' in navigator)) return true
      return false
    },
    share () {
      if (!('share' in navigator)) {
        return
      }

      navigator.share({
        title: 'Aplicacion de tareas',
        text: 'Can I rely on the Web Platform features to build my app? An overview of the device integration HTML5 APIs',
        url: 'https://tasks.mirokshi.scool.cat'
      })
        .then(() => console.log('Successful share'))
        .catch(error => console.log('Error sharing:', error))
    }
  }
}
</script>

<style scoped>

</style>
