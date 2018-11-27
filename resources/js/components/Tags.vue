<template>
    <div>
        <v-btn @click="snackbarMessage"></v-btn>
        <v-btn @click="snackbarMessage"></v-btn>
    </div>

</template>

<script>
export default {
  name: 'tags',
  data () {
    return {

    }
  },
  methods: {
    showMessage () {
      this.$snackbar.showMessage('Missatge exemple')
    },
    showError () {
      this.$snackbar.showError('Error exemple')
    }
  }
}
</script>
