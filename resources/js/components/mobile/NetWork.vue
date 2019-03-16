<template>
    <span>
        <p>Current theoretical network type is <b id="networkType">not available</b>.</p>
        <p>Current effective network type is <b id="effectiveNetworkType">not available</b>.</p>
        <p>Current max downlink speed is <b id="downlinkMax">not available</b></p>
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
