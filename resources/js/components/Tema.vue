<template>
    <span>
           <swatches v-model="colorPrincipal" inline></swatches>
        <v-btn @click="principalDefault">DEFAULT</v-btn>
    </span>
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
      colorPrincipal: window.localStorage.getItem('PRIMARY_COLOR_KEY')
    }
  },
  watch: {
    colorPrincipal () {
      window.localStorage.setItem('PRIMARY_COLOR_KEY', this.colorPrincipal)
      this.$vuetify.theme.primary = this.colorPrincipal
    }
  },
  methods: {
    principalDefault () {
      window.localStorage.removeItem('PRIMARY_COLOR_KEY')
    }
  }
}
</script>

<style scoped>
</style>
