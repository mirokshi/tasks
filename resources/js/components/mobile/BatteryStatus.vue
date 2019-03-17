<template>
    <span>
        <p>Estado inicial de la bateria <b id="charging">desconocido</b>.</p>
        <p>Tiempo de carga <b id="chargingTime">desconocido</b>.</p>
        <p>Tiempo de descargar <b id="dischargingTime">desconocido</b>.</p>
        <p>Nivel <b id="level">desconocido</b>.</p>
        <div id="target"></div>
        </span>
</template>

<script>
var target = document.getElementById('target')
export default {
  name: 'BatteryStatus',
  components: {
    handleChange (change) {
      var timeBadge = new Date().toTimeString().split(' ')[0]
      var newState = document.createElement('p')
      newState.innerHTML = '<span class="badge">' + timeBadge + '</span> ' + change + '.'
      target.appendChild(newState)
    },
    onChargingChange () {
      this.handleChange('Battery charging changed to <b>' + (this.charging ? 'cargando' : 'descargando') + '</b>')
    },
    onChargingTimeChange () {
      this.handleChange('Battery charging time changed to <b>' + this.chargingTime + ' s</b>')
    },
    onDischargingTimeChange () {
      this.handleChange('Battery discharging time changed to <b>' + this.dischargingTime + ' s</b>')
    },
    onLevelChange () {
      this.handleChange('Battery level changed to <b>' + this.level + '</b>')
    }
  },
  mounted () {
    if ('getBattery' in navigator || ('battery' in navigator && 'Promise' in window)) {
      var batteryPromise
      if ('getBattery' in navigator) {
        batteryPromise = navigator.getBattery()
      } else {
        batteryPromise = Promise.resolve(navigator.battery)
      }
      batteryPromise.then(function (battery) {
        document.getElementById('charging').innerHTML = battery.charging ? 'cargando' : 'descargando'
        document.getElementById('chargingTime').innerHTML = battery.chargingTime + ' s'
        document.getElementById('dischargingTime').innerHTML = battery.dischargingTime + ' s'
        document.getElementById('level').innerHTML = battery.level

        battery.addEventListener('chargingchange', this.onChargingChange)
        battery.addEventListener('chargingtimechange', this.onChargingTimeChange)
        battery.addEventListener('dischargingtimechange', this.onDischargingTimeChange)
        battery.addEventListener('levelchange', this.onLevelChange)
      })
    }
  }
}

</script>

<style scoped>

</style>
