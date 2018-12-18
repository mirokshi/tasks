<template>
    <v-switch :loading="loading" :disabled="loading" v-model="dataCompleted" :label="dataCompleted ? 'Completada' : 'Pendiente'"></v-switch>
</template>

<script>
export default {
  name: 'Toggle',
  data () {
    return {
      dataCompleted: this.completed,
      loading: false
    }
  },
  props: {
    completed: {
      type: Boolean,
      required: true
    },
    id: {
      type: Number,
      required: true
    }
  },
  watch: {
    completed (completed) {
      this.dataCompleted = completed
    },
    dataCompleted (dataCompleted, oldDataCompleted) {
      console.log('CAMBIO')
      console.log('nuevo')
      console.log(dataCompleted)
      console.log('antiguo')
      console.log(oldDataCompleted)
      if (dataCompleted) {
        this.loading = true
        window.axios.post('/api/v1/completed_task/' + this.id).then(response => {
          this.$snackbar.showMessage('Se ha actualizado correctamente')
          this.loading = false
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.loading = false
        })
      } else {
        this.loading = true
        window.axios.delete('/api/v1/completed_task/' + this.id).then(response =>{
          this.$snackbar.showMessage('Se ha actualizado correctamente')
          this.loading = false
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.loading = false
        })
      }
    }
  }

}
</script>
