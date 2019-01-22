<template>
    <span></span>
</template>

<script>
export default {
  name: 'ServiceWorker',
  // QUIERO EJECUTAR EL REGISTRE DEL SERVICE WORKER
  mounted () {
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/service-worker.js')
    } else {
      console.log('NAVEGADOR OBSOLETO')
    }
  }
}
</script>

<style scoped>

</style>
