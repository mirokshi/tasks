<template>
    <v-card>
        <v-card-title>
            <div>
                <v-btn class="btn btn-default" id="askButton">Ask for location</v-btn>
                <div id="target"></div>
            </div>
        </v-card-title>
    </v-card>
</template>
<script>
var target = document.getElementById('target')
var el = document.getElementById('askButton')
export default {
  name: 'Geolocation',
  methods: {
    async appendLocation (location, verb) {
      verb = verb || 'updated'
      var newLocation = document.createElement('p')
      newLocation.innerHTML = 'Location ' + verb + ': <a href="https://maps.google.com/maps?&z=15&q=' + location.coords.latitude + '+' + location.coords.longitude + '&ll=' + location.coords.latitude + '+' + location.coords.longitude + '" target="_blank">' + location.coords.latitude + ', ' + location.coords.longitude + '</a>'
      target.appendChild(newLocation)
    }
  },
  mounted () {
    var watchId
    if ('geolocation' in navigator) {
      document.addEventListener('DOMContentLoaded', function () {
        el.addEventListener('click', function () {
          navigator.geolocation.getCurrentPosition(function (location) {
            this.appendLocation(location, 'fetched')
          }, false)
          watchId = navigator.geolocation.watchPosition(this.appendLocation)
        })
      })
    } else {
      target.innerText = 'Geolocation API not supported.'
    }
  }
}
</script>
