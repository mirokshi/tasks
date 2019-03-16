<template>
    <span>
        <v-btn @click="vibrateSimple"><v-icon>vibration</v-icon></v-btn>
        <v-btn @click="vibratePattern">VIBRATION</v-btn>
    </span>
</template>

<script>
export default {
  name: 'Vibration',
  components: {
    vibrateSimple () {
      if (navigator.vibrate) {
        navigator.vibrate(200)
      }
    },
    vibratePattern () {
      if (navigator.vibrate) {
        navigator.vibrate([100, 200, 200, 200, 500])
      }
    }
  }
}
</script>

<style scoped>

</style>
