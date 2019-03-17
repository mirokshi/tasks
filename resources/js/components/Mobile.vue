<template>
    <span>
        <v-layout>
        <!--<geolocation></geolocation>-->
        <!--<device-position></device-position>-->
            <!--<network></network>-->
            <!--<vibration></vibration>-->
            <!--<battery-status></battery-status>-->
            <online-state></online-state>
        </v-layout>
    </span>
</template>

<script>

import DevicePostion from './mobile/DevicePosition'
import Geolocation from './mobile/Geolocation'
import NetWork from './mobile/NetWork'
import Vibration from './mobile/Vibration'
import BatteryStatus from './mobile/BatteryStatus'
import OnlineState from './mobile/OnlineState'
export default {
  name: 'mobile',
  components: {
    'device-position': DevicePostion,
    'geolocation': Geolocation,
    'network': NetWork,
    'vibration': Vibration,
    'battery-status': BatteryStatus,
    'online-state': OnlineState
  }
}
</script>

<style scoped>

</style>
