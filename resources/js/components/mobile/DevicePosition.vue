<template>
    <span>
        <div class="container" id="logoContainer">
            <img src="img/geo.png" id="imgLogo">
        </div>
    </span>
</template>

<script>
export default {
  name: 'DevicePostion',
  methods: {
    deviceOrientationHandler (eventData) {
      var tiltLR = eventData.gamma
      var tiltFB = eventData.beta
      var dir = eventData.alpha
      Math.round(tiltLR)
      Math.round(tiltFB)
      Math.round(dir)

      var logo = document.getElementById('imgLogo')
      logo.style.webkitTransform = 'rotate(' + tiltLR + 'deg) rotate3d(1,0,0, ' + (tiltFB * -1) + 'deg)'
      logo.style.MozTransform = 'rotate(' + tiltLR + 'deg)'
      logo.style.transform = 'rotate(' + tiltLR + 'deg) rotate3d(1,0,0, ' + (tiltFB * -1) + 'deg)'
    }

  },
  mounted () {
    if ('DeviceOrientationEvent' in window
    ) {
      window.addEventListener('deviceorientation', this.deviceOrientationHandler, false)
    } else {
      document.getElementById('logoContainer').innerText = 'Device Orientation API not supported.'
    }
  }
}

</script>

<style scoped>
    .container {
        perspective: 300px;
        -webkit-perspective: 300px;
    }

    #imgLogo {
        width: 275px;
        margin-left: auto;
        margin-right: auto;
        display: block;
        padding: 15px;
    }

</style>
