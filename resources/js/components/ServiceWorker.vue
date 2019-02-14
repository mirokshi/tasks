<template>
    <span></span>
</template>

<script>
export default {
  name: 'ServiceWorker',
  methods: {
    registerServiceWorker () {
      if (!('serviceWorker' in navigator)) {
        console.log('Service workers are not supported in tyhis browser')
        return
      }
      navigator.serviceWorker.register('/service-worker.js')
        .then(function (registration) {
          console.log('Registratin succesfull, scope is : ', registration.scope)
        })
        .catch(function (error) {
          console.log('Service worker resgistration failed, errror :', error)
        })
    }
  },
  // QUIERO EJECUTAR EL REGISTRE DEL SERVICE WORKER
  mounted () {
    this.registerServiceWorker()
  }
}
</script>

<style scoped>

</style>
