<template>
    <span>
        <p>Turn the network connection on/off to see the changes.</p>
        <p>Initial connection state was <b class="status">unknown</b>.</p>
        <div id="target">unknown</div>
    </span>
</template>

<script>

var target = document.getElementById('target')
export default {
  name: 'OnlineState',
  components: {
    async handleStateChange () {
      var timeBadge = new Date().toTimeString().split(' ')[0]
      let newState = await document.createElement('p')
      var state = navigator.onLine ? 'online' : 'offline'
      if (newState) {
        newState.innerHTML = '<span class="badge">' + timeBadge + '</span> Connection state changed to <b>' + state + '</b>.'
        target.appendChild(newState)
      }
    },
    hola () {
      document.getElementById('status').innerHTML = navigator.onLine ? 'online' : 'offline'
    }

  },

  mounted () {
    window.addEventListener('online', this.handleStateChange)
    window.addEventListener('offline', this.handleStateChange)
    window.onload = this.hola
  }
}

</script>

<style scoped>

</style>
