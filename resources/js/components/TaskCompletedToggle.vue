<template>
    <v-switch  v-model="task.completed" :label="task.completed ? 'Completada' : 'Pendiente'"></v-switch>
</template>

<script>
export default {
  name: 'TaskCompletedToggle',
  data () {
    return {
      dataTask: this.task
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
    completedTask () {
      //LOADING Y DISABLED
      window.axios.post('/v1/completed_task/' + this.task.id) //TODO ACABAR
    },
    uncompletedTask () {
      window.axios.delete('/v1/completed_task/' + this.task.id) //TODO ACABAR

    }
  }
}
</script>
