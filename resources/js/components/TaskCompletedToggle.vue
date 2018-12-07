<template>
    <v-switch  :loading="loading":disabled="loading" v-model="task.completed" :label="task.completed ? 'Completada' : 'Pendiente'"></v-switch>
</template>

<script>
export default {
  name: 'TaskCompletedToggle',
  data () {
    return {
      dataTask: this.task,
      loading: false
    }
  },
  props: {
    task: {
      type: Boolean,
      required: true
    }
  },
  watch: {
    task (task) {
      this.dataTask = task
    },
    dataTask: {
      handler: function (dataTask) {
        if (dataTask.completed) this.completedTask()
        else this.uncompletedTask()
      },
      deep: true
    }
  },
  methods: {
    async uncompleteTask () {
      // LOADING I DISABLED TODO
      this.loading = true
      await window.axios.post('/api/v1/completed_task/' + this.task.id).then((response) => {
        this.$snackbar.showMessage('Se ha marcado como incompleto correctamente')
        this.loading = false
      }).catch(error => {
        this.$snackbar.showError(error)
        this.removing = null
      }) // TODO ACABAR
    },
    async completeTask () {
      this.loading = true
      await window.axios.delete('/api/v1/completed_task/' + this.task.id).then((response) => {
        this.$snackbar.showMessage('Se ha completado correctamente la tarea')
        this.loading = false
      }).catch(error => {
        this.$snackbar.showError(error)
        this.removing = null
      }) // TODO ACABAR
    }
  }
}
</script>
