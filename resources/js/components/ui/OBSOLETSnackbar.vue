<template>
    <v-snackbar :timeout="timeout" :color="color" v-model="show">
        {{message }}
        <v-btn dark flat @click="show=false" >X</v-btn>
    </v-snackbar>
</template>

<script>


export default {
  data () {
    return {
      message: '',
      timeout: 3000,
      color: 'success',
      show: false
    }
  },
  methods: {
    // SNACKNBAR
    showMessage (message) {
      this.message = message
      this.color = 'success'
      this.show = true
    },
    showError (error) {
      this.message = error.message
      this.color = 'error'
      this.show = true
    }
  },
  mounted () {
    EventBus.$on('showSnackbar', () => {
      this.show = true
    })
    EventBus.$on('showError', () => {
      this.showError()
    })
    EventBus.$on('showMessage', () => {
      this.showMessage()
    })
  }
}

</script>

<style scoped>

</style>
