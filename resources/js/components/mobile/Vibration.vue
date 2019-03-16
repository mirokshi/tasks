<template>
    <span>
        <v-btn @click="party"><v-icon>vibration</v-icon></v-btn>
        <v-btn @click="party2"><v-icon>person</v-icon></v-btn>
    </span>
</template>

<script>
export default {
  name: 'Vibration',
  methods: {
    party () {
      if (navigator.vibrate) {
        navigator.vibrate([100, 200, 200, 200, 500])
      }
    },
    party2 () {
      if (navigator.vibrate) {
        navigator.vibrate(200)
      }
    }
  }
}
</script>

<style scoped>

</style>
