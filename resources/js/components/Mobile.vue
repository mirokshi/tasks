<template>
    <span>
        <!--<geolocation></geolocation>-->
        <device-position></device-position>
    </span>
</template>

<script>

import DevicePostion from './others/DevicePosition'
export default {
  name: 'mobile',
  components: {
    'device-position': DevicePostion
  }
}
</script>

<style scoped>

</style>
