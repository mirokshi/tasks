<template>
    <v-card color="blue-grey darken-2" class="white--text">
        <v-card-title primary-title>
            <div>
                <div class="headline">Activa / desactiva la conexión de red para ver los cambios.</div>
                <span>El estado de conexión inicial era <b id="status">desconocido</b>.</span>
                <span id="target">desconocido</span>
            </div>
        </v-card-title>
    </v-card>
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
        newState.innerHTML = '<span class="badge">' + timeBadge + '</span> El estado de conexión cambió a <b>' + state + '</b>.'
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
