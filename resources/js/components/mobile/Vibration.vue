<template>
        <v-btn @click="vib"><v-icon>vibration</v-icon></v-btn>
</template>

<script>
export default {
  name: 'Vibration',
  methods: {
    vib () {
      if (navigator.vibrate) {
        navigator.vibrate([100, 200, 200, 200, 500])
      }
    }
  }
}
</script>

<style scoped>

</style>
