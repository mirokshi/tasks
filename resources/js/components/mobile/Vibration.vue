<template>
    <span>
        <v-btn @click="vibratePattern">VIBRATION</v-btn>
    </span>
</template>

<script>
export default {
  name: 'Vibration',
  components: {
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
