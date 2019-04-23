<template>
    <span>
        <v-card class="justify-center">
            <v-flex class="text-xs-center mt-3">
        <video id="demovideo" src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4" preload="auto" controls></video>
            </v-flex>
<div class="text-xs-center">
    <v-btn onclick="document.getElementById('demovideo').play()" flat icon><v-icon>play_arrow</v-icon></v-btn>
    <v-btn onclick="document.getElementById('demovideo').pause()" flat icon><v-icon>pause</v-icon></v-btn>
    <v-btn onclick="document.getElementById('demovideo').volume+=0.1" flat icon><v-icon>volume_up</v-icon></v-btn>
    <v-btn onclick="document.getElementById('demovideo').volume-=0.1" flat icon><v-icon>volume_down</v-icon></v-btn>
    <v-btn @click="rewind('demovideo')" flat icon><v-icon>fast_rewind</v-icon></v-btn>
    <v-btn @click="forward('demovideo')" flat icon><v-icon>fast_forward</v-icon></v-btn>
</div>
        </v-card>
<div class="test">Back in black:</div>

<audio id="demo" src="https://upload.wikimedia.org/wikipedia/en/4/45/ACDC_-_Back_In_Black-sample.ogg" preload="auto" controls></audio>

<div>
    <button onclick="document.getElementById('demo').play()">Reproducir el Audio</button>
    <button onclick="document.getElementById('demo').pause()">Pausar el Audio</button>
    <button onclick="document.getElementById('demo').volume+=0.1">Aumentar el Volumen</button>
    <button onclick="document.getElementById('demo').volume-=0.1">Disminuir el Volumen</button>
</div>

<div class="test">Audio Another day in paradise:</div>

<audio id="demo2" src="https://upload.wikimedia.org/wikipedia/en/9/9f/Sample_of_%22Another_Day_in_Paradise%22.ogg" preload="auto" controls></audio>

<div>
    <button onclick="document.getElementById('demo2').play()">Reproducir el Audio</button>
    <button onclick="document.getElementById('demo2').pause()">Pausar el Audio</button>
    <button onclick="document.getElementById('demo2').volume+=0.1">Aumentar el Volumen</button>
    <button onclick="document.getElementById('demo2').volume-=0.1">Disminuir el Volumen</button>
</div>

<div class="test">Audio Bullet in the head:</div>

<audio id="demo3" src="https://upload.wikimedia.org/wikipedia/en/1/17/Bullet_In_The_Head.ogg" preload="auto" controls></audio>

<div>
    <button onclick="document.getElementById('demo3').play()">Reproducir el Audio</button>
    <button onclick="document.getElementById('demo3').pause()">Pausar el Audio</button>
    <button onclick="document.getElementById('demo3').volume+=0.1">Aumentar el Volumen</button>
    <button onclick="document.getElementById('demo3').volume-=0.1">Disminuir el Volumen</button>
</div>

<a href="https://developer.mozilla.org/es/docs/Web/HTML/Usando_audio_y_video_con_HTML5">Més info</a>
    </span>
</template>

<script>
export default {
  name: 'ComponentVideo',
    methods:{
      rewind ($id) {
          let video = document.getElementById($id)
          video.currentTime += -5
      },
        forward ($id) {
          let video = document.getElementById($id)
            video.currentTime += +5
        },
}
}
</script>

<style scoped>

</style>
