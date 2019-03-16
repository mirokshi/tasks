<template>
    <span>
        <v-layout>
        <!--<geolocation></geolocation>-->
        <!--<device-position></device-position>-->
            <network></network>
            <vibration></vibration>
        </v-layout>
    </span>
</template>

<script>

import DevicePostion from './mobile/DevicePosition'
import Geolocation from './mobile/Geolocation'
import NetWork from './mobile/NetWork'
import Vibration from './mobile/Vibration'
export default {
  name: 'mobile',
  components: {
    'vibration': Vibration,
    'device-position': DevicePostion,
    'geolocation': Geolocation,
    'network': NetWork
  }
}
</script>

<style scoped>

</style>
