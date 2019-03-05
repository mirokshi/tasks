<tempate>
    <span>
    <button class="btn btn-default" id="askButton">Ask for location</button>
    <div id="target"></div>
</span>
</tempate>
<script>
var target = document.getElementById('target')
var watchId

function appendLocation (location, verb) {
  verb = verb || 'updated'
  var newLocation = document.createElement('p')
  newLocation.innerHTML = 'Location ' + verb + ': <a href="https://maps.google.com/maps?&z=15&q=' + location.coords.latitude + '+' + location.coords.longitude + '&ll=' + location.coords.latitude + '+' + location.coords.longitude + '" target="_blank">' + location.coords.latitude + ', ' + location.coords.longitude + '</a>'
  target.appendChild(newLocation)
}
var el = document.getElementById('askButton')
if ('geolocation' in navigator) {
  el.addEventListener('click', function () {
    navigator.geolocation.getCurrentPosition(function (location) {
      appendLocation(location, 'fetched')
    })
    watchId = navigator.geolocation.watchPosition(appendLocation)
  })
} else {
  target.innerText = 'Geolocation API not supported.'
}
</script>
