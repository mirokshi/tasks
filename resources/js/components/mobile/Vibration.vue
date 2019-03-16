<template>
    <span>
        <button class="btn btn-default" onclick="vibrateSimple()">Vibrate for 200 ms</button>
        <button class="btn btn-default" onclick="vibratePattern()">Vibrate with pattern</button>
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
