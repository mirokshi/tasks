<template>
    <v-card>
        <v-card-title class="grey darken-3 white--text"><h4>Tema</h4></v-card-title>
           <swatches v-model="color" inline></swatches>
        <v-btn>Aplicar</v-btn>
    </v-card>
</template>

<script>
import Swatches from 'vue-swatches'
// Import the styles too, globally
import 'vue-swatches/dist/vue-swatches.min.css'
export default {
  name: 'Tema',
  components: { Swatches },
  data () {
    return {
      color: '#2680C2'
    }
  },
  watch: {
    color: function (newColor) {
      window.localStorage.setItem('PRIMARY_COLOR_KEY', newColor)
    }
  }
}
</script>

<style scoped>
</style>
