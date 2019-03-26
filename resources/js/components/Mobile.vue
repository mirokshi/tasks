<template>
    <v-layout row>
        <v-flex xs12 md10 offset-md-1>
            <v-card>
                <v-toolbar dark color="primary">
                    <v-toolbar-title>
                        Device Info
                    </v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <h5>Coordinates</h5>
                    <h6>{{ coordinates }}</h6>
                    <h5>Battery</h5>
                    <h6>{{ dataBattery.level*100 }} %</h6>
                    <h5>Device Memory</h5>
                    <h6>{{ memory() }} GB</h6>
                    <h5>Connection Speed</h5>
                    <h6>{{ internet().downlink }} Mb/s ({{ internet().effectiveType }})</h6>
                    <h5>Vibrate</h5>
                    <vibration></vibration>
                    <device-position></device-position>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
import DevicePosition from './mobile/DevicePosition'
import Vibration from './mobile/Vibration'


export default {
  name: 'Mobile',
  components: {
    'device-position': DevicePosition,
    'vibration': Vibration,
  },
  methods: {
    async gps () {
      if ('geolocation' in navigator) {
        await navigator.geolocation.getCurrentPosition(location => {
          this.coordinates = location.coords.latitude + ', ' + location.coords.longitude
        })
        await navigator.geolocation.watchPosition(location => {
          this.coordinates = location.coords.latitude + ', ' + location.coords.longitude
        })
      } else {
        this.coordinates = 'Geolocation API not supported in your device.'
      }
    },
    memory () {
      return navigator.deviceMemory
    },
    internet () {
      return navigator.connection
    },
    async battery () {
      let batteryPromise
      if ('getBattery' in navigator) {
        batteryPromise = navigator.getBattery()
      } else {
        batteryPromise = Promise.resolve(navigator.battery)
      }
      let result = await batteryPromise.then((battery) => {
        this.dataBattery = battery
      })
    },
    vibrate () {
      navigator.vibrate([400, 200, 100, 200, 400])
    },
    refresh () {
      this.battery()
      this.gps()
    }
  },
  data () {
    return {
      dataBattery: false,
      coordinates: false
    }
  },
  created () {
    this.battery()
    this.gps()
  }
}
</script>
