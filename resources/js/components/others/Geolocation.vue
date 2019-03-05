<template>
    <span>
    <table class="table table-striped table-bordered">
  <tr>
    <td>Tilt Left/Right [gamma]</td>
    <td id="doTiltLR"></td>
  </tr>
  <tr>
    <td>Tilt Front/Back [beta]</td>
    <td id="doTiltFB"></td>
  </tr>
  <tr>
    <td>Direction [alpha]</td>
    <td id="doDirection"></td>
  </tr>
</table>

<div class="container" id="logoContainer">
  <img src="https://www.w3.org/html/logo/downloads/HTML5_Badge_512.png" id="imgLogo">
</div>

<p><small>Demo from <a href="https://www.html5rocks.com/en/tutorials/device/orientation/" target="_blank">HTML5 Rocks</a> article.</small></p>>
    </span>
</template>

<script>
if ('DeviceOrientationEvent' in window) {
  window.addEventListener('deviceorientation', deviceOrientationHandler, false)
} else {
  document.getElementById('logoContainer').innerText = 'Device Orientation API not supported.'
}

function deviceOrientationHandler (eventData) {
  var tiltLR = eventData.gamma
  var tiltFB = eventData.beta
  var dir = eventData.alpha

  document.getElementById('doTiltLR').innerHTML = Math.round(tiltLR)
  document.getElementById('doTiltFB').innerHTML = Math.round(tiltFB)
  document.getElementById('doDirection').innerHTML = Math.round(dir)

  var logo = document.getElementById('imgLogo')
  logo.style.webkitTransform = 'rotate(' + tiltLR + 'deg) rotate3d(1,0,0, ' + (tiltFB * -1) + 'deg)'
  logo.style.MozTransform = 'rotate(' + tiltLR + 'deg)'
  logo.style.transform = 'rotate(' + tiltLR + 'deg) rotate3d(1,0,0, ' + (tiltFB * -1) + 'deg)'
}
</script>

<style scoped>
    .container {
        perspective: 300;
        -webkit-perspective: 300;
    }

    #imgLogo {
        width: 275px;
        margin-left: auto;
        margin-right: auto;
        display: block;
        padding: 15px;
    }

</style>
