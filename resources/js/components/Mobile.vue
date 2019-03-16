<template>
    <span>
        <v-layout>
        <geolocation></geolocation>
        <!--<device-position></device-position>-->
        </v-layout>
    </span>
</template>

<script>

import DevicePostion from './others/DevicePosition'
import Geolocation from './others/Geolocation'
export default {
  name: 'mobile',
  components: {
    'device-position': DevicePostion,
    'geolocation': Geolocation
  }
}
</script>

<style scoped>

</style>
