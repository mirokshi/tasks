<template>
    <span>
        <geolocation></geolocation>
    </span>
</template>

<script>
import Geolocation from './others/Geolocation'
export default {
  name: 'mobile',
  components: { 'geolocation': Geolocation }
}
</script>

<style scoped>

</style>
