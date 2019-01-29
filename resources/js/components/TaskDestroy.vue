<template>
    <v-btn v-can="'tasks.destroy'" icon color="error" flat title="Eliminar la tasca"
           :loading="removing" :disabled="removing"
           @click="destroy(task)">
        <v-icon>delete</v-icon>
    </v-btn>
</template>

<script>
export default {
  'name': 'TaskDestroy',
  data () {
    return {
      removing: false
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    async destroy (task) {
      // ES6 async await
      let result = await this.$confirm('Las tareas borradas ya no se podrán recuperar',
        {
          title: 'Esta seguro?',
          buttonTruetext: 'Eliminar',
          buttonFalsetext: 'Cancelar',
          color: 'error'
        })
      if (result) {
        this.removing = true
        window.axios.delete(this.uri + task.id).then(() => {
          this.$snackbar.showMessage('Se ha borrado correctamente la tarea')
          this.$emit('removed', task)
          this.removing = false
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.removing = false
        })
      }
    }
  }
}
</script>
