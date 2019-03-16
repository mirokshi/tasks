<template>
    <span>
        <v-layout>
        <!--<geolocation></geolocation>-->
        <!--<device-position></device-position>-->
            <!--<network></network>-->
            <!--<vibration></vibration>-->
            <battery-status></battery-status>
        </v-layout>
    </span>
</template>

<script>

import DevicePostion from './mobile/DevicePosition'
import Geolocation from './mobile/Geolocation'
import NetWork from './mobile/NetWork'
import Vibration from './mobile/Vibration'
import BatteryStatus from './mobile/BatteryStatus'
export default {
  name: 'mobile',
  components: {
    'device-position': DevicePostion,
    'geolocation': Geolocation,
    'network': NetWork,
    'vibration': Vibration,
    'battery-status': BatteryStatus
  }
}
</script>

<style scoped>

</style>
