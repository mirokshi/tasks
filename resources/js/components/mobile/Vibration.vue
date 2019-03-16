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
      navigator.vibrate(200)
    },
    vibratePattern () {
      navigator.vibrate([100, 200, 200, 200, 500])
    }
  }
}
</script>

<style scoped>

</style>
