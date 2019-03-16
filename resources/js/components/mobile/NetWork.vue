<template>
    <span>
        <v-layout>
        <p>Tipo de red efectivo: <b id="networkType">No definida</b>.</p>
        <p>Tipo de red recurrente:  <b id="effectiveNetworkType">Not definida</b>.</p>
        <p>Velocidad maxima <b id="downlinkMax">No definida</b></p>
    </v-layout>
    </span>
</template>

<script>
export default {
  name: 'NetWork',
  methods: {
    getConnection () {
      return navigator.connection || navigator.mozConnection ||
        navigator.webkitConnection || navigator.msConnection
    },
    updateNetworkInfo (info) {
      document.getElementById('networkType').innerHTML = info.type
      document.getElementById('effectiveNetworkType').innerHTML = info.effectiveType
      document.getElementById('downlinkMax').innerHTML = info.downlinkMax
    }
  },
  mounted () {
    var info = this.getConnection()
    if (info) {
      info.addEventListener('change', this.updateNetworkInfo)
      this.updateNetworkInfo(info)
    }
  }
}
</script>

<style scoped>

</style>
